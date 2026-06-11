<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;

class AffiliateCouponController extends Controller
{
    public function apply(Request $request)
    {
        $data = $request->validate([
            'coupon_code' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $affiliate = Affiliate::where('coupon_code', strtoupper($data['coupon_code']))->first();

        if (!$affiliate) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.'], 422);
        }

        if (!$affiliate->isApproved()) {
            return response()->json(['success' => false, 'message' => 'This coupon is not active yet.'], 422);
        }

        $discount = min($affiliate->calculateCommission((float) $data['amount']), (float) $data['amount']);

        session([
            'affiliate_coupon' => [
                'affiliate_id' => $affiliate->id,
                'coupon_code' => $affiliate->coupon_code,
                'discount' => $discount,
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'coupon_code' => $affiliate->coupon_code,
            'discount' => $discount,
            'total' => max((float) $data['amount'] - $discount, 0),
        ]);
    }
}
