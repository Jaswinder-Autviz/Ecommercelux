<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
