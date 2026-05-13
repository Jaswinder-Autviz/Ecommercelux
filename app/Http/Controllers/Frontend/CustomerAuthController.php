<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OtpVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerAuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10',
        ]);

        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);

        OtpVerification::updateOrCreate(
            ['phone' => $request->phone],
            [
                'otp' => $request->otp ?? $otp, // Use actual service in production
                'expires_at' => $expiresAt,
                'is_verified' => false
            ]
        );

        // In production, send SMS here
        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully to ' . $request->phone,
            'otp' => $otp // Sending in response for testing purposes only!
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10',
            'otp' => 'required|numeric|digits:6',
        ]);

        $verification = OtpVerification::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired OTP.'
            ], 422);
        }

        $verification->update(['is_verified' => true]);

        $customer = Customer::firstOrCreate(
            ['phone' => $request->phone],
            ['phone_verified_at' => Carbon::now()]
        );

        Auth::guard('customer')->login($customer, true);

        return response()->json([
            'status' => 'success',
            'message' => 'Logged in successfully.',
            'redirect' => route('customer.account')
        ]);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
