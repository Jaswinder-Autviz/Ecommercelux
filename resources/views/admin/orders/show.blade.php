@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Order Details</h1>
            <p class="text-sm text-gray-500">Order #{{ $order->order_number }} - Placed on {{ $order->created_at->format('d M, Y H:i') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-primary transition-all text-sm font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Order Items & Summary -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="font-bold text-gray-900">Ordered Products</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-[11px] uppercase tracking-wider  font-bold">
                                <th class="px-6 py-4">Product</th>
                                <th class="px-6 py-4">Price</th>
                                <th class="px-6 py-4">Quantity</th>
                                <th class="px-6 py-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ asset('assets/images/products/' . ($item->product->main_image ?? '1.jpg')) }}" class="w-12 h-12 rounded-lg object-cover border border-gray-100">
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ $item->product->name ?? 'Deleted Product' }}</p>
                                            <p class="text-[11px] ">SKU: {{ $item->product->sku ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">₹{{ number_format($item->price) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">₹{{ number_format($item->price * $item->quantity) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-sm text-gray-500 text-right">Subtotal</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">₹{{ number_format($order->total_amount) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-sm text-gray-500 text-right">Shipping</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">₹{{ number_format($order->shipping_amount) }}</td>
                            </tr>
                            @if($order->discount_amount > 0)
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-sm text-gray-500 text-right">Discount</td>
                                <td class="px-6 py-4 text-sm font-bold text-red-500 text-right">-₹{{ number_format($order->discount_amount) }}</td>
                            </tr>
                            @endif
                            <tr class="bg-primary/5">
                                <td colspan="3" class="px-6 py-4 text-base font-bold text-gray-900 text-right">Grand Total</td>
                                <td class="px-6 py-4 text-lg font-bold text-primary text-right">₹{{ number_format($order->final_amount) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4 mb-4">Shipping Information</h3>
                <div class="text-sm text-gray-600 space-y-1">
                    <p class="font-bold text-gray-900">{{ $order->customer_name }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>Phone: {{ $order->customer_phone }}</p>
                    <p>Email: {{ $order->customer_email }}</p>
                </div>
            </div>
        </div>

        <!-- Right: Actions & Status -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4">Order Status</h3>
                
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Fulfillment Status</label>
                        <select name="order_status" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Payment Status</label>
                        <select name="payment_status" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full text-white bg-primary font-bold py-3 rounded-xl transition-all shadow-lg shadow-primary/20">
                        Update Status
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4">Customer Details</h3>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold">
                        {{ strtoupper(substr($order->customer_name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                        <p class="text-[11px] text-gray-400">Customer since {{ $order->user ? $order->user->created_at->format('M Y') : 'N/A' }}</p>
                    </div>
                </div>
                <button class="w-full border border-gray-200 text-gray-600 text-sm font-bold py-2 rounded-lg hover:bg-gray-50 transition-all">
                    View Profile
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
