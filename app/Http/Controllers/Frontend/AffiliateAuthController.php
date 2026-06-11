<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Support\AffiliateWithdrawalBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AffiliateAuthController extends Controller
{
    public function showRegister()
    {
        return view('affiliate.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:affiliates,email',
            'phone' => 'nullable|string|max:30',
            'social_media_url' => 'required|url|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['coupon_code'] = $this->makeCouponCode($data['name']);
        $data['commission_type'] = 'percentage';
        $data['commission_value'] = 0;
        $data['status'] = 'pending';

        Affiliate::create($data);

        return redirect()->route('affiliate.login')->with('success', 'Registration submitted. Your affiliate account is pending admin approval.');
    }

    public function showLogin()
    {
        return view('affiliate.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $affiliate = Affiliate::where('email', $credentials['email'])->first();

        if (!$affiliate || !Hash::check($credentials['password'], $affiliate->password)) {
            return back()->withInput($request->only('email'))->with('error', 'Invalid affiliate login details.');
        }

        if (!$affiliate->isApproved()) {
            return back()->withInput($request->only('email'))->with('error', 'Your affiliate account is pending admin approval.');
        }

        Auth::guard('affiliate')->login($affiliate, true);
        $request->session()->regenerate();

        return redirect()->route('affiliate.dashboard');
    }

    public function dashboard()
    {
        $affiliate = Auth::guard('affiliate')->user();
        $balance = AffiliateWithdrawalBalance::for($affiliate);
        $orders = $affiliate->orders()->with('order')->latest()->paginate(10);

        return view('affiliate.dashboard', compact('affiliate', 'orders', 'balance'));
    }

    public function logout(Request $request)
    {
        Auth::guard('affiliate')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('affiliate.login')->with('success', 'Logged out successfully.');
    }

    private function makeCouponCode(string $name): string
    {
        do {
            $code = strtoupper(Str::slug(Str::limit($name, 10, ''), '') . random_int(100, 999));
        } while (Affiliate::where('coupon_code', $code)->exists());

        return $code;
    }
}
