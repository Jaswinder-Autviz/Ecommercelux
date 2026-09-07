@extends('frontend.customer.layouts.account')

@section('account_content')
<div class="space-y-8">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Overview</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-primary/5 p-6 rounded-2xl border border-primary/10">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Total Orders</p>
                <h3 class="text-3xl font-bold text-primary">{{ $totalOrders }}</h3>
            </div>
            <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Items in Cart</p>
                <h3 class="text-3xl font-bold text-blue-500">{{ $cartCount }}</h3>
            </div>
            <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100">
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Saved Items</p>
                <h3 class="text-3xl font-bold text-purple-500">{{ $wishlistCount }}</h3>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-900 text-lg">Recent Orders</h3>
            <a href="{{ route('customer.account', ['tab' => 'orders']) }}" class="text-xs font-bold text-primary uppercase tracking-widest hover:underline">View All</a>
        </div>
        <div class="p-8">
            @forelse($recentOrders as $order)
                <div class="flex flex-col md:flex-row items-center justify-between p-6 bg-gray-50 rounded-2xl mb-4 hover:bg-gray-100 transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center border border-gray-200 overflow-hidden">
                            <i class="fas fa-shopping-bag text-gray-300"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Order #{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-400">Placed on {{ $order->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right mt-4 md:mt-0">
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-lg">{{ $order->order_status }}</span>
                        <p class="text-sm font-bold text-gray-900 mt-2">₹{{ number_format($order->final_amount) }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shopping-bag text-2xl text-gray-200"></i>
                    </div>
                    <p class="text-gray-400">You haven't placed any orders yet.</p>
                    <a href="{{ route('shop') }}" class="inline-block mt-4 text-primary font-bold hover:underline">Start Shopping →</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
