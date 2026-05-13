<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAccountController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $recentOrders = Order::where('customer_id', $customer->id)->latest()->take(3)->get();
        $addresses = $customer->addresses;
        return view('frontend.customer.account_single', compact('customer', 'recentOrders', 'addresses'));
    }

    public function profile()
    {
        return redirect()->route('customer.account', ['tab' => 'profile']);
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['name', 'email', 'gender', 'dob']);

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('assets/images/customers'), $imageName);
            $data['profile_image'] = $imageName;
        }

        $customer->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function addresses()
    {
        return redirect()->route('customer.account', ['tab' => 'address']);
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'mobile_number' => 'required|numeric|digits:10',
            'pincode' => 'required|numeric|digits:6',
            'state' => 'required|string',
            'city' => 'required|string',
            'street_address' => 'required|string',
            'address_type' => 'required|in:home,office'
        ]);

        $customer = Auth::guard('customer')->user();

        // If this is the first address, make it default
        $isDefault = $customer->addresses()->count() === 0;

        $customer->addresses()->create($request->all() + ['is_default' => $isDefault]);

        return back()->with('success', 'Address added successfully.');
    }

    public function orders()
    {
        return redirect()->route('customer.account', ['tab' => 'orders']);
    }
}
