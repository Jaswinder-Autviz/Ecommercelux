<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OtpVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('customer')->attempt($credentials, true)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password.',
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged in successfully.',
            'redirect' => route('customer.account'),
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('customer')->login($customer, true);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Account created successfully.',
            'redirect' => route('customer.account'),
        ]);
    }

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

        $botToken = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');
        $verifySsl = filter_var(config('services.telegram.verify_ssl'), FILTER_VALIDATE_BOOLEAN);
        $message = "OTP Verification\n\nPhone: +91{$request->phone}\nOTP: {$otp}\nExpires in: 5 minutes";

        if (!$botToken || !$chatId) {
            Log::error('Telegram OTP credentials are missing.', [
                'has_bot_token' => !empty($botToken),
                'has_chat_id' => !empty($chatId),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'OTP service is not configured. Please try again later.',
            ], 500);
        }

        try {
            $telegramResponse = Http::timeout(15)
                ->withOptions(['verify' => $verifySsl])
                ->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $message,
                ]);

            if (!$telegramResponse->successful()) {
                Log::error('Telegram OTP send failed.', [
                    'phone' => $request->phone,
                    'chat_id' => $chatId,
                    'status' => $telegramResponse->status(),
                    'body' => $telegramResponse->body(),
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'OTP could not be sent. Please try again.',
                ], 502);
            }

            Log::info('Telegram OTP sent successfully.', [
                'phone' => $request->phone,
                'chat_id' => $chatId,
            ]);
        } catch (\Throwable $exception) {
            Log::error('Telegram OTP request exception.', [
                'phone' => $request->phone,
                'chat_id' => $chatId,
                'message' => $exception->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'OTP could not be sent. Please try again.',
            ], 502);
        }

        if (
            env('WHATSAPP_API_KEY')
            && env('WHATSAPP_PHONE')
            && env('WHATSAPP_API_KEY') !== 'your_callmebot_api_key'
            && env('WHATSAPP_PHONE') !== 'your_whatsapp_number'
        ) {
            $whatsappMessage = urlencode("OTP Verification\nPhone: +91{$request->phone}\nOTP: {$otp}\nExpires in: 5 minutes");
            Http::get("https://api.callmebot.com/whatsapp.php", [
                'phone' => env('WHATSAPP_PHONE'),
                'text' => $whatsappMessage,
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
