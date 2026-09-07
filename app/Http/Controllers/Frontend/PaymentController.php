<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    private function api()
    {
        return new Api(
            env('RAZORPAY_KEY_ID'),
            env('RAZORPAY_KEY_SECRET')
        );
    }

    // Create Razorpay order
    public function createOrder(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'name'   => 'required|string',
            'email'  => 'required|email',
            'phone'  => 'required|string',
        ]);

        try {
            $order = $this->api()->order->create([
                'receipt'         => 'order_' . time(),
                'amount'          => (int)($request->amount * 100), // paise
                'currency'        => 'INR',
                'payment_capture' => 1,
            ]);

            return response()->json([
                'success'  => true,
                'order_id' => $order->id,
                'amount'   => $order->amount,
                'currency' => $order->currency,
                'key'      => env('RAZORPAY_KEY_ID'),
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Verify payment signature
    public function verifyPayment(Request $request)
    {
        $request->validate([
            'razorpay_order_id'   => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature'  => 'required',
        ]);

        try {
            $this->api()->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            // Payment verified — store order here if needed
            return response()->json([
                'success'    => true,
                'payment_id' => $request->razorpay_payment_id,
                'message'    => 'Payment successful!',
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }
    }

    public function submitOrder(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:50',
            'address'     => 'required|string|max:1000',
            'city'        => 'required|string|max:255',
            'state'       => 'required|string|max:255',
            'pin'         => 'required|string|max:20',
            'method'      => 'required|string|in:cod,googlepay,upi,card,netbanking',
            'amount'      => 'required|numeric|min:0.01',
            'coupon_code' => 'nullable|string|max:50',
            'items'       => 'required|array|min:1',
            'items.*.bundle_size'  => 'required|integer|in:5,10',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.price'        => 'required|numeric|min:0',
            'items.*.size'         => 'required|string',
            'items.*.posters'      => 'required|array',
        ]);

        // ── STRICT BUNDLE VALIDATION ──────────────────────────────────────────
        foreach ($request->items as $item) {
            $bundleSize = (int) ($item['bundle_size'] ?? 0);
            if (!in_array($bundleSize, [5, 10], true)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Orders are only allowed for 5 Poster or 10 Poster Bundles.'
                ], 422);
            }

            $posters = $item['posters'] ?? [];
            if (count($posters) !== $bundleSize) {
                return response()->json([
                    'success' => false,
                    'message' => "The {$bundleSize} Poster Bundle must contain exactly {$bundleSize} posters."
                ], 422);
            }

            // Extract IDs and check for duplicates
            $posterIds = array_values(array_filter(array_map(fn($p) => $p['id'] ?? null, $posters)));
            if (count($posterIds) !== $bundleSize || count(array_unique($posterIds)) !== $bundleSize) {
                return response()->json([
                    'success' => false,
                    'message' => 'Duplicate posters are not allowed in a bundle. Each poster in a bundle must be unique.'
                ], 422);
            }

            // Verify all posters exist in DB and are active
            $validPostersCount = Product::whereIn('id', $posterIds)->where('status', true)->count();
            if ($validPostersCount !== $bundleSize) {
                return response()->json([
                    'success' => false,
                    'message' => 'One or more posters in your bundle are invalid or unavailable.'
                ], 422);
            }

            // Verify size is 12 x 8 inches
            $size = trim((string)($item['size'] ?? ''));
            $allowedSizes = [
                '12 × 8 inches', '12×8 inches', '12 × 8', '12×8', '12 x 8 inches', '12x8',
                Product::POSTER_SIZE
            ];
            if (!in_array($size, $allowedSizes, true)) {
                return response()->json([
                    'success' => false,
                    'message' => 'All posters must be in standard 12 × 8 inches size.'
                ], 422);
            }
        }

        $subtotal = collect($request->items)->sum(function ($item) {
            return (float) $item['price'];
        });

        $affiliate = null;
        $couponCode = strtoupper((string) ($request->coupon_code ?: session('affiliate_coupon.coupon_code')));
        $discountAmount = 0;
        $commissionAmount = 0;

        if ($couponCode) {
            $affiliate = Affiliate::where('coupon_code', $couponCode)->where('status', 'approved')->first();

            if (!$affiliate) {
                return response()->json(['success' => false, 'message' => 'Invalid or inactive affiliate coupon.'], 422);
            }

            $discountAmount = min($affiliate->calculateCommission($subtotal), $subtotal);
            $commissionAmount = $discountAmount;
        }

        $finalAmount = max($subtotal - $discountAmount, 0);

        $orderData = [
            'order_number'     => $this->generateOrderNumber(),
            'customer_name'    => $request->name,
            'customer_email'   => $request->email,
            'customer_phone'   => $request->phone,
            'shipping_address' => trim($request->address . ', ' . $request->city . ', ' . $request->state . ' - ' . $request->pin),
            'total_amount'     => $subtotal,
            'discount_amount'  => $discountAmount,
            'shipping_amount'  => 0,
            'final_amount'     => $finalAmount,
            'payment_method'   => $request->method,
            'payment_status'   => $request->method === 'cod' ? 'pending' : 'paid',
            'order_status'     => 'pending',
            'customer_id'      => Auth::guard('customer')->check() ? Auth::guard('customer')->id() : null,
        ];

        DB::beginTransaction();
        try {
            $order = Order::create($orderData);

            foreach ($request->items as $item) {
                $bundleSize = (int) $item['bundle_size'];
                $posters = $item['posters'];
                $firstPosterId = $posters[0]['id'] ?? null;

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $firstPosterId,
                    'product_name' => $item['product_name'] ?? "{$bundleSize} Poster Bundle (12 × 8 inches)",
                    'quantity'     => 1,
                    'price'        => $item['price'],
                    'size'         => Product::POSTER_SIZE,
                    'options'      => [
                        'type'        => 'bundle',
                        'bundle_size' => $bundleSize,
                        'posters'     => $posters,
                    ],
                    'total'        => $item['price'],
                ]);
            }

            if ($affiliate) {
                AffiliateOrder::create([
                    'affiliate_id' => $affiliate->id,
                    'order_id' => $order->id,
                    'coupon_code' => $affiliate->coupon_code,
                    'order_amount' => $subtotal,
                    'commission_amount' => $commissionAmount,
                    'status' => 'pending',
                ]);

                $affiliate->increment('total_orders');
                $affiliate->increment('total_sales', $subtotal);
                $affiliate->increment('total_commission', $commissionAmount);
                session()->forget('affiliate_coupon');
            }

            DB::commit();

            return response()->json(['success' => true, 'order_number' => $order->order_number]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Unable to create order. Please try again.'], 500);
        }
    }

    private function generateOrderNumber(): string
    {
        do {
            $number = 'HUSTLER' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}
