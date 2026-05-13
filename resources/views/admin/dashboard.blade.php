@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
            <p class="text-sm text-gray-500">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-200 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all flex items-center">
                <i class="far fa-calendar-alt mr-2"></i> Last 30 Days
            </button>
            <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Product
            </button>
        </div>
    </div>

    <!-- Stats Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Orders -->
        <div class="stat-card bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </div>
                <span class="text-[11px] font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+12.5%</span>
            </div>
            <p class="text-sm font-medium text-gray-400">Total Orders</p>
            <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_orders']) }}</h3>
        </div>

        <!-- Total Products -->
        <div class="stat-card bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-box text-xl"></i>
                </div>
                <span class="text-[11px] font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">Stable</span>
            </div>
            <p class="text-sm font-medium text-gray-400">Total Products</p>
            <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_products']) }}</h3>
        </div>

        <!-- Total Revenue -->
        <div class="stat-card bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon w-12 h-12 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <span class="text-[11px] font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+8.2%</span>
            </div>
            <p class="text-sm font-medium text-gray-400">Total Revenue</p>
            <h3 class="text-2xl font-bold text-gray-900 mt-1">₹{{ number_format($stats['total_revenue']) }}</h3>
        </div>

        <!-- Total Customers -->
        <div class="stat-card bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="stat-icon w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <span class="text-[11px] font-bold text-red-500 bg-red-50 px-2 py-1 rounded-lg">-2.4%</span>
            </div>
            <p class="text-sm font-medium text-gray-400">Total Customers</p>
            <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_customers']) }}</h3>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="font-bold text-gray-900">Revenue Overview</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs font-bold text-primary bg-primary/10 rounded-lg">Sales</button>
                    <button class="px-3 py-1 text-xs font-bold text-gray-400 hover:text-gray-600 transition-all">Orders</button>
                </div>
            </div>
            <canvas id="revenueChart" height="120"></canvas>
        </div>

        <!-- Recent Customers -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-6">Recent Customers</h3>
            <div class="space-y-6">
                @forelse($recent_customers as $customer)
                <div class="flex items-center justify-between group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 font-bold group-hover:bg-primary group-hover:text-gray-400 transition-all">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $customer->name }}</p>
                            <p class="text-[11px] text-gray-400">{{ $customer->email }}</p>
                        </div>
                    </div>
                    <button class="p-2 text-gray-400 hover:text-primary transition-all">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>
                @empty
                <p class="text-center text-gray-400 text-sm italic">No recent customers.</p>
                @endforelse
            </div>
            <button class="w-full mt-8 py-3 bg-gray-50 text-gray-600 text-xs font-bold rounded-xl hover:bg-primary hover:text-white transition-all uppercase tracking-wider">
                View All Customers
            </button>
        </div>

        <!-- Latest Orders -->
        <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Latest Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-primary hover:underline uppercase tracking-wider">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-400 font-bold">
                            <th class="px-8 py-4">Order ID</th>
                            <th class="px-8 py-4">Customer</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4">Total</th>
                            <th class="px-8 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($latest_orders as $order)
                        <tr class="hover:bg-gray-50 transition-all group">
                            <td class="px-8 py-4 text-sm font-bold text-gray-900">#{{ $order->order_number }}</td>
                            <td class="px-8 py-4">
                                <span class="text-sm font-medium text-gray-600">{{ $order->customer_name }}</span>
                            </td>
                            <td class="px-8 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter 
                                    @if($order->order_status == 'delivered') bg-green-50 text-green-500
                                    @elseif($order->order_status == 'pending') bg-blue-50 text-blue-500
                                    @elseif($order->order_status == 'cancelled') bg-red-50 text-red-500
                                    @else bg-gray-50 text-gray-400 @endif">
                                    {{ $order->order_status }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-sm font-bold text-gray-900">₹{{ number_format($order->final_amount) }}</td>
                            <td class="px-8 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="p-2 text-gray-400 hover:text-primary transition-all">
                                    <i class="far fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Selling Products -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-6">Top Selling Products</h3>
            <div class="space-y-6">
                @forelse($top_selling_products as $product)
                <div class="flex items-center justify-between group">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('assets/images/products/' . ($product->main_image ?? '1.jpg')) }}" class="w-10 h-10 rounded-xl object-cover border border-gray-50 group-hover:scale-110 transition-all">
                        <div>
                            <p class="text-sm font-bold text-gray-900 truncate w-32">{{ $product->name }}</p>
                            <p class="text-[11px] text-gray-400">{{ $product->order_items_count }} Sales</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900">₹{{ number_format($product->price) }}</p>
                        <p class="text-[10px] text-green-500 font-bold">Trending</p>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-400 text-sm italic">No sales data.</p>
                @endforelse
            </div>
            <button class="w-full mt-8 py-3 bg-gray-50 text-gray-600 text-xs font-bold rounded-xl hover:bg-primary hover:text-white transition-all uppercase tracking-wider">
                Full Report
            </button>
        </div>

        <!-- Low Stock / Pending Section -->
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-8">
            <div>
                <h3 class="font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-exclamation-triangle text-orange-400 mr-2"></i> Low Stock Alert
                </h3>
                <div class="space-y-4">
                    @forelse($low_stock_products as $product)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-2xl">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('assets/images/products/' . ($product->main_image ?? '1.jpg')) }}" class="w-10 h-10 rounded-lg object-cover">
                            <div>
                                <p class="text-xs font-bold text-gray-900 truncate w-32">{{ $product->name }}</p>
                                <p class="text-[10px] text-gray-400">SKU: {{ $product->sku }}</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-red-500">{{ $product->stock_quantity }} left</span>
                    </div>
                    @empty
                    <p class="text-[11px] text-gray-400 italic">All products well stocked.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-8 border-t border-gray-50">
                <h3 class="font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-clock text-blue-400 mr-2"></i> Pending Actions
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Pending Orders</span>
                        <span class="font-bold text-gray-900">{{ $latest_orders->where('order_status', 'pending')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Unread Reviews</span>
                        <span class="font-bold text-gray-900">12</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue',
                data: [3000, 4500, 3200, 5000, 7000, 6500, 8000, 9500, 8500, 11000, 10500, 13000],
                borderColor: '#e8353b',
                backgroundColor: 'rgba(255, 63, 108, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointBackgroundColor: '#e8353b',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: true, color: 'rgba(0,0,0,0.02)' },
                    ticks: { font: { size: 10 }, color: '#9ca3af' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10 }, color: '#9ca3af' }
                }
            }
        }
    });
</script>
@endpush
@endsection
