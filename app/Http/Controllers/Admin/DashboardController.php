<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('final_amount'),
            'total_customers' => User::where('is_admin', false)->count(),
        ];

        $latest_orders = Order::latest()->take(5)->get();
        $recent_customers = User::where('is_admin', false)->latest()->take(5)->get();
        $low_stock_products = Product::where('stock_quantity', '<', 10)->take(5)->get();
        
        // Top selling products (based on order items)
        $top_selling_products = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_orders', 'recent_customers', 'low_stock_products', 'top_selling_products'));
    }
}
