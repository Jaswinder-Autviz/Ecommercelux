@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Orders</h1>
            <p class="text-sm text-gray-500">Manage customer orders and track fulfillment.</p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-all">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
            <button class="bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-all">
                <i class="fas fa-download mr-2"></i> Export
            </button>
        </div>
    </div>

    <!-- Order Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">New Orders</p>
            <h3 class="text-xl font-bold text-gray-900">{{ $orders->where('order_status', 'pending')->count() }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Processing</p>
            <h3 class="text-xl font-bold text-gray-900">{{ $orders->where('order_status', 'processing')->count() }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Delivered</p>
            <h3 class="text-xl font-bold text-gray-900">{{ $orders->where('order_status', 'delivered')->count() }}</h3>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Cancelled</p>
            <h3 class="text-xl font-bold text-gray-900">{{ $orders->where('order_status', 'cancelled')->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[11px] uppercase tracking-wider  font-bold">
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Method</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Payment</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">#{{ $order->order_number }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-900">{{ $order->customer_name }}</span>
                                <span class="text-[11px] text-gray-400">{{ $order->customer_email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 uppercase">
                            {{ $order->payment_method }}
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">
                            ₹{{ number_format($order->final_amount) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter 
                                @if($order->order_status == 'delivered') bg-green-50 text-green-500
                                @elseif($order->order_status == 'pending') bg-blue-50 text-blue-500
                                @elseif($order->order_status == 'processing') bg-yellow-50 text-yellow-500
                                @elseif($order->order_status == 'cancelled') bg-red-50 text-red-500
                                @else bg-gray-50 text-gray-400 @endif">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter 
                                @if($order->payment_status == 'paid') bg-green-50 text-green-500
                                @elseif($order->payment_status == 'pending') bg-yellow-50 text-yellow-500
                                @else bg-red-50 text-red-500 @endif">
                                {{ $order->payment_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm ">
                            {{ $order->created_at->format('d M, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center px-3 py-1 bg-gray-50 text-gray-600 rounded-lg text-xs font-bold hover:bg-primary hover:text-gray-400 transition-all">
                                Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center  italic">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-50">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
