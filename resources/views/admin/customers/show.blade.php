@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Customer Details</h1>
            <p class="text-sm text-gray-500">Full record for {{ $customer->name ?? 'Guest User' }}</p>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="text-gray-500 hover:text-primary transition-all text-sm font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Back to Customers
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <div class="w-24 h-24 rounded-3xl bg-primary/10 flex items-center justify-center text-primary font-bold text-3xl mx-auto mb-4 border border-primary/20">
                    {{ strtoupper(substr($customer->name ?? 'G', 0, 1)) }}
                </div>
                <h3 class="text-xl font-bold text-gray-900">{{ $customer->name ?? 'Guest User' }}</h3>
                <p class="text-sm text-gray-400">{{ $customer->email ?? 'No Email Address' }}</p>
                
                <div class="mt-8 pt-8 border-t border-gray-50 space-y-4 text-left">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Phone</span>
                        <span class="font-bold text-gray-900">+91 {{ $customer->phone }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Gender</span>
                        <span class="font-bold text-gray-900 capitalize">{{ $customer->gender ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Birthday</span>
                        <span class="font-bold text-gray-900">{{ $customer->dob ? $customer->dob->format('d M, Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Joined</span>
                        <span class="font-bold text-gray-900">{{ $customer->created_at->format('d M, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm grid grid-cols-2 gap-4">
                <div class="bg-blue-50 p-4 rounded-2xl text-center">
                    <p class="text-[10px] text-blue-400 font-bold uppercase">Total Orders</p>
                    <h4 class="text-2xl font-bold text-blue-500">{{ $customer->orders->count() }}</h4>
                </div>
                <div class="bg-purple-50 p-4 rounded-2xl text-center">
                    <p class="text-[10px] text-purple-400 font-bold uppercase">Addresses</p>
                    <h4 class="text-2xl font-bold text-purple-500">{{ $customer->addresses->count() }}</h4>
                </div>
            </div>
        </div>

        <!-- History Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Saved Addresses -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="font-bold text-gray-900">Saved Addresses</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($customer->addresses as $address)
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 relative">
                            @if($address->is_default)
                                <span class="absolute top-2 right-2 bg-primary text-gray-400 text-[8px] font-bold px-1.5 py-0.5 rounded uppercase">Default</span>
                            @endif
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ $address->address_type }}</h4>
                            <p class="text-sm font-bold text-gray-900">{{ $address->full_name }}</p>
                            <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                                {{ $address->street_address }}, {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic">No addresses saved.</p>
                    @endforelse
                </div>
            </div>

            <!-- Order History -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="font-bold text-gray-900">Order History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-400 font-bold">
                                <th class="px-6 py-4">Order ID</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Total</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($customer->orders as $order)
                            <tr class="hover:bg-gray-50 transition-all">
                                <td class="px-6 py-4 text-sm font-bold text-gray-900">#{{ $order->order_number }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $order->order_status == 'delivered' ? 'bg-green-50 text-green-500' : 'bg-blue-50 text-blue-500' }}">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900">₹{{ number_format($order->final_amount) }}</td>
                                <td class="px-6 py-4 text-sm ">{{ $order->created_at->format('d M, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary hover:underline text-xs font-bold uppercase tracking-widest">Details</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center  italic">No orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
