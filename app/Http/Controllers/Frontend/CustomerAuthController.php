<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OtpVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
                'otp' => $otp,
                'expires_at' => $expiresAt,
                'is_verified' => false
            ]
        );

        // Send OTP via Telegram
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        $message = "🔐 *OTP Verification*\n\nPhone: +91{$request->phone}\nOTP: *{$otp}*\nExpires in: 5 minutes";

        Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown',
        ]);

        // Send OTP via WhatsApp (CallMeBot)
        if (env('WHATSAPP_API_KEY') && env('WHATSAPP_PHONE')) {
            $whatsappMessage = urlencode("🔐 OTP Verification\nPhone: +91{$request->phone}\nOTP: {$otp}\nExpires in: 5 minutes");
            Http::get("https://api.callmebot.com/whatsapp.php", [
                'phone' => env('WHATSAPP_PHONE'),
                'text'  => $whatsappMessage,
                'apikey' => env('WHATSAPP_API_KEY'),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully to ' . $request->phone,
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
