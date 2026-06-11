@extends('affiliate.layout')

@section('title', 'Affiliate Dashboard - Hustler')

@section('content')
<div class="space-y-7">
    <div>
        <p class="text-sm font-bold uppercase tracking-widest text-primary">Affiliate Dashboard</p>
        <h1 class="mt-1 text-3xl font-bold text-gray-950">Welcome, {{ $affiliate->name }}</h1>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Coupon Code</p>
            <p class="mt-3 text-2xl  uppercase tracking-widest text-gray-950">{{ $affiliate->coupon_code }}</p>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Total Orders Generated</p>
            <p class="mt-3 text-3xl  text-gray-950">{{ $affiliate->total_orders }}</p>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Total Sales Amount</p>
            <p class="mt-3 text-3xl  text-gray-950">₹{{ number_format($affiliate->total_sales, 2) }}</p>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Total Commission</p>
            <p class="mt-3 text-3xl  text-primary">₹{{ number_format($affiliate->total_commission, 2) }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="border-b border-gray-100 px-6 py-4">
            <h2 class="font-extrabold text-gray-950">Orders From Your Coupon</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Customer Name</th>
                        <th class="px-6 py-4">Order Amount</th>
                        <th class="px-6 py-4">Coupon Code</th>
                        <th class="px-6 py-4">Commission</th>
                        <th class="px-6 py-4">Order Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $affiliateOrder)
                        <tr>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">#{{ $affiliateOrder->order?->order_number ?? $affiliateOrder->order_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $affiliateOrder->order?->customer_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">₹{{ number_format($affiliateOrder->order_amount, 2) }}</td>
                            <td class="px-6 py-4 text-xs font-extrabold uppercase tracking-widest text-gray-500">{{ $affiliateOrder->coupon_code }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-primary">₹{{ number_format($affiliateOrder->commission_amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $affiliateOrder->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-gray-400">No affiliate orders yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-50 p-6">{{ $orders->links() }}</div>
    </div>
</div>
@endsection
