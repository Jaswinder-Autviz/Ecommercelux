<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AffiliateWithdrawal;
use App\Support\AffiliateWithdrawalBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AffiliateWithdrawalController extends Controller
{
    public function index()
    {
        $affiliate = Auth::guard('affiliate')->user();
        $balance = AffiliateWithdrawalBalance::for($affiliate);
        $withdrawals = $affiliate->withdrawals()->latest()->paginate(10);

        return view('affiliate.redeem', compact('affiliate', 'balance', 'withdrawals'));
    }

    public function store(Request $request)
    {
        $affiliate = Auth::guard('affiliate')->user();

        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:10'],
            'gpay_upi_id' => ['required', 'string', 'max:120', 'regex:/^[a-zA-Z0-9.\-_]{2,}@[a-zA-Z]{2,}[a-zA-Z0-9.\-_]*$/'],
            'note' => ['nullable', 'string', 'max:1000'],
        ], [
            'gpay_upi_id.regex' => 'Please enter a valid GPay/UPI ID like name@okaxis or mobile@oksbi.',
        ]);

        DB::transaction(function () use ($affiliate, $data) {
            DB::table('affiliates')->where('id', $affiliate->id)->lockForUpdate()->first();

            $balance = AffiliateWithdrawalBalance::for($affiliate);
            $amount = round((float) $data['amount'], 2);

            if ($amount > $balance['available_balance']) {
                throw ValidationException::withMessages([
                    'amount' => 'Redeem amount cannot be greater than your available balance.',
                ]);
            }

            AffiliateWithdrawal::create([
                'affiliate_id' => $affiliate->id,
                'amount' => $amount,
                'payment_method' => 'gpay',
                'gpay_upi_id' => $data['gpay_upi_id'],
                'note' => $data['note'] ?? null,
                'status' => 'pending',
                'requested_at' => now(),
            ]);
        });

        return redirect()->route('affiliate.redeem')->with('success', 'Redeem request submitted successfully.');
    }
}
