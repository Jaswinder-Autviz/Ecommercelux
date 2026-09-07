<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OtpVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.account');
        }
        return view('frontend.auth.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
        ]);

        $key = 'otp:' . $request->phone;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'status' => 'error',
                'message' => "Too many OTP requests. Try again in {$seconds} seconds.",
            ], 429);
        }

        RateLimiter::hit($key, 300); // 5-minute window

        $otp = rand(100000, 999999);

        OtpVerification::updateOrCreate(
            ['phone' => $request->phone],
            [
                'otp'         => $otp,
                'expires_at'  => Carbon::now()->addMinutes(5),
                'is_verified' => false,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'OTP generated.',
            'demo_otp' => $otp, // Development only — remove in production
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
            'otp'   => 'required|digits:6',
        ]);

        $verification = OtpVerification::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->where('is_verified', false)
            ->first();

        if (!$verification) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid or expired OTP.',
            ], 422);
        }

        $verification->update(['is_verified' => true]);

        $customer = Customer::firstOrCreate(
            ['phone' => $request->phone],
            ['phone_verified_at' => Carbon::now()]
        );

        Auth::guard('customer')->login($customer, true);
        $request->session()->regenerate();

        return response()->json([
            'status'   => 'success',
            'message'  => 'Logged in successfully.',
            'redirect' => route('customer.account'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login');
    }
}
