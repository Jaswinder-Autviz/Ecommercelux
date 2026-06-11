<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerAccountController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $orders = Order::where(function ($query) use ($customer) {
                $query->where('customer_id', $customer->id);

                if ($customer->email) {
                    $query->orWhere('customer_email', $customer->email);
                }

                if ($customer->phone) {
                    $query->orWhere('customer_phone', $customer->phone);
                }
            })
            ->latest()
            ->get();
        $recentOrders = $orders->take(3);
        $addresses = $customer->addresses;
        $totalOrders = $orders->count();
        
        try {
            $cartCount = DB::table('cart_items')
                ->join('carts', 'carts.id', '=', 'cart_items.cart_id')
                ->where('carts.customer_id', $customer->id)
                ->count();
        } catch (\Exception $e) {
            $cartCount = 0;
        }

        try {
            $wishlistCount = DB::table('wishlists')->where('customer_id', $customer->id)->count();
        } catch (\Exception $e) {
            $wishlistCount = 0;
        }

        return view('frontend.customer.account_single', compact('customer', 'orders', 'recentOrders', 'addresses', 'totalOrders', 'cartCount', 'wishlistCount'));
    }

    public function profile()
    {
        return redirect()->route('customer.account', ['tab' => 'profile']);
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:20',
        ]);

        $name = trim($request->first_name . ' ' . $request->last_name);
        $data = [
            'name' => $name,
            'email' => $request->email,
            'phone' => preg_replace('/\D+/', '', $request->phone),
        ];

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

        $address = $customer->addresses()->create($request->all() + ['is_default' => $isDefault]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'address' => $address]);
        }

        return back()->with('success', 'Address added successfully.');
    }

    public function updateAddress(Request $request, $id)
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

        $address = CustomerAddress::where('customer_id', $customer->id)->where('id', $id)->firstOrFail();

        $address->update($request->all());

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'address' => $address]);
        }

        return back()->with('success', 'Address updated successfully.');
    }

    public function orders()
    {
        return redirect()->route('customer.account', ['tab' => 'orders']);
    }
}
