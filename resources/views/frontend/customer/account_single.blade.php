@extends('frontend.layouts.app')

@section('title', 'My Account - Hustler')

@section('content')
@php $nameParts = explode(' ', trim(Auth::guard('customer')->user()->name ?? '')); @endphp
<div class="min-h-screen bg-white pt-32 pb-20">
    <div class="container mx-auto px-4 max-w-6xl">
        
        {{-- Greeting Header --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl font-medium text-gray-900">
                <span id="greeting">Good afternoon!</span> {{ explode(' ', Auth::guard('customer')->user()->name ?? 'Guest')[0] }}
            </h1>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            
            {{-- Premium Red Sidebar --}}
            <aside class="w-full lg:w-80 flex-shrink-0">
                <div class="bg-primary rounded-[40px] shadow-2xl overflow-hidden p-6 text-white min-h-[550px] flex flex-col">
                    
                    {{-- User Profile Header --}}
                    <div class="flex items-center space-x-4 mb-10 p-2">
                        <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl font-bold border border-white/30">
                            {{ strtoupper(substr(Auth::guard('customer')->user()->name ?? 'G', 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold leading-tight truncate w-40">{{ Auth::guard('customer')->user()->name ?? 'Jaswinder Singh' }}</h3>
                          
                        </div>
                    </div>

                    {{-- Navigation Tabs --}}
                    <nav class="flex-1">
                        <ul class="space-y-2">
                            <li>
                                <button onclick="switchTab('profile')" class="tab-btn active w-full flex items-center justify-between px-5 py-4 rounded-2xl transition-all hover:bg-white/10 group" data-tab="profile">
                                    <div class="flex items-center space-x-4">
                                        <i class="far fa-user text-lg"></i>
                                        <span class="font-bold">My profile</span>
                                    </div>
                                    <i class="fas fa-chevron-right text-[10px] opacity-0 group-hover:opacity-100 transition-all"></i>
                                </button>
                            </li>
                       
                            <li>
                                <button onclick="switchTab('orders')" class="tab-btn w-full flex items-center justify-between px-5 py-4 rounded-2xl transition-all hover:bg-white/10 group" data-tab="orders">
                                    <div class="flex items-center space-x-4">
                                        <i class="fas fa-shopping-basket text-lg"></i>
                                        <span class="font-bold">Order history</span>
                                    </div>
                                    <span class="bg-white/20 w-5 h-5 flex items-center justify-center text-[10px] rounded-md font-bold">{{ $totalOrders }}</span>
                                </button>
                            </li>
                            <li>
                                <button onclick="switchTab('address')" class="tab-btn w-full flex items-center justify-between px-5 py-4 rounded-2xl transition-all hover:bg-white/10 group" data-tab="address">
                                    <div class="flex items-center space-x-4">
                                        <i class="fas fa-map-marker-alt text-lg"></i>
                                        <span class="font-bold">Delivery address</span>
                                    </div>
                                    <span class="bg-white/20 w-5 h-5 flex items-center justify-center text-[10px] rounded-md font-bold">{{ $addresses->count() }}</span>
                                </button>
                            </li>
                    
                    
                        </ul>
                    </nav>

                    {{-- Logout --}}
                    <div class="mt-auto pt-6 border-t border-white/10">
                        <form action="{{ route('customer.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center space-x-4 px-5 py-4 rounded-2xl transition-all hover:bg-white/10 text-white/90">
                                <i class="fas fa-power-off text-lg"></i>
                                <span class="font-bold">Log out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- Main Content Area (Single Page) --}}
            <main class="flex-1">
                <div class="bg-white rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 p-10 min-h-[550px]">
                    @if(session('success'))
                        <div class="mb-6 rounded-3xl border border-green-200 bg-green-50 p-5 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Profile Tab --}}
                    <div id="tab-profile" class="tab-content space-y-10">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-800">Profile Details</h2>
                        </div>

                        <form action="{{ route('customer.profile.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                            @csrf
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">First name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $nameParts[0] ?? '') }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">Last name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $nameParts[1] ?? '') }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::guard('customer')->user()->email ?? '') }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">Contact number</label>
                                <input type="text" name="phone" value="{{ old('phone', Auth::guard('customer')->user()->phone ?? '') }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            <div class="md:col-span-2 flex justify-end pt-4">
                                <button type="submit" class="bg-primary text-white px-8 py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all font-bold">Save changes</button>
                            </div>
                        </form>
                    </div>

                    {{-- Loyalty Tab --}}
                    <div id="tab-loyalty" class="tab-content hidden space-y-6">
                        <h2 class="text-xl font-bold text-gray-800">Loyalty Program</h2>
                        <div class="bg-primary/5 p-8 rounded-[32px] border border-primary/10 text-center">
                            <i class="fas fa-gift text-5xl text-primary mb-4"></i>
                            <h3 class="text-2xl font-bold text-gray-900">₹94.95</h3>
                            <p class="text-gray-500">Your total reward points</p>
                        </div>
                    </div>

                    {{-- Orders Tab --}}
                    <div id="tab-orders" class="tab-content hidden space-y-6">
                        <h2 class="text-xl font-bold text-gray-800">Order History</h2>
                        @if($orders->count())
                            <div class="space-y-4">
                                @foreach($orders as $order)
                                    <div class="p-6 bg-[#f0f4f9] rounded-[24px] flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm">
                                                <i class="fas fa-shopping-bag"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800">Order #{{ $order->order_number ?? 'ORD-' . $order->id }}</p>
                                                <p class="text-xs text-gray-500">Placed on {{ $order->created_at->format('d M, Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-primary">₹{{ number_format($order->final_amount ?? $order->total_amount ?? 0, 2) }}</p>
                                            <span class="text-[10px] font-bold uppercase {{ ($order->order_status ?? $order->payment_status) === 'delivered' ? 'text-green-500' : 'text-blue-500' }}">{{ ucfirst($order->order_status ?? $order->payment_status ?? 'Pending') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 border border-dashed rounded-[32px] text-center text-gray-500">
                                <i class="fas fa-box-open text-4xl mb-4"></i>
                                <p>No orders found yet. Your order history will appear here once you place an order.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Address Tab --}}
                    <div id="tab-address" class="tab-content hidden space-y-6">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-800">Saved Addresses</h2>
                                <button onclick="document.getElementById('addressModal').classList.remove('hidden')" class="bg-primary text-gray-400 px-5 py-2 rounded-xl text-xs font-bold shadow-lg shadow-primary/20">Add New</button>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            @forelse($addresses as $address)
                                <div class="p-6 border-2 rounded-[24px] bg-white relative {{ $address->is_default ? 'border-primary bg-primary/5' : 'border-gray-100' }}">
                                    @if($address->is_default)
                                        <span class="absolute top-4 right-4 bg-primary text-gray-100 text-[10px] px-2 py-0.5 rounded-md font-bold uppercase">Default</span>
                                    @endif
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h4 class="font-bold text-gray-800 capitalize">{{ $address->address_type }}</h4>
                                            <p class="text-sm text-gray-500">{{ $address->full_name }}</p>
                                        </div>
                                        <span class="text-xs uppercase tracking-[0.15em] text-gray-400">Saved</span>
                                    </div>
                                    <p class="text-sm text-gray-500 leading-relaxed mb-3">
                                        {{ $address->street_address }}{{ $address->landmark ? ', ' . $address->landmark : '' }}<br>
                                        {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                                    </p>
                                    <p class="text-sm text-gray-500">Phone: {{ $address->mobile_number }}</p>
                                </div>
                            @empty
                                <div class="p-8 border border-dashed rounded-3xl text-center text-gray-500">
                                    <i class="far fa-address-card text-4xl mb-4"></i>
                                    <p>No saved addresses yet.</p>
                                    <button onclick="document.getElementById('addressModal').classList.remove('hidden')" class="mt-4 bg-primary text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-primary/20 transition-all">Add your first address</button>
                                </div>
                            @endforelse
                        </div>
                    
                        {{-- Add Address Modal (embedded for account page) --}}
                        <div id="addressModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
                            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="this.parentElement.classList.add('hidden')"></div>
                            <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden p-8 max-h-[90vh] overflow-y-auto">
                                <h3 class="text-2xl font-bold text-gray-900 mb-8">Add New Address</h3>
                            
                                <form action="{{ route('customer.addresses.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                                        <input type="text" name="full_name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mobile Number</label>
                                        <input type="text" name="mobile_number" required maxlength="10" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pincode</label>
                                        <input type="text" name="pincode" required maxlength="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">State</label>
                                        <input type="text" name="state" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">City</label>
                                        <input type="text" name="city" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Landmark (Optional)</label>
                                        <input type="text" name="landmark" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Street Address</label>
                                        <textarea name="street_address" required rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Address Type</label>
                                        <div class="flex space-x-4">
                                            <label class="flex-1">
                                                <input type="radio" name="address_type" value="home" checked class="hidden peer">
                                                <div class="text-center py-3 rounded-xl border border-gray-100 bg-gray-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary cursor-pointer transition-all font-bold text-sm">Home</div>
                                            </label>
                                            <label class="flex-1">
                                                <input type="radio" name="address_type" value="office" class="hidden peer">
                                                <div class="text-center py-3 rounded-xl border border-gray-100 bg-gray-50 peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary cursor-pointer transition-all font-bold text-sm">Office</div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="md:col-span-2 flex space-x-4 pt-4">
                                        <button type="submit" class="flex-1 bg-primary text-gray-400 font-bold py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                                            Save Address
                                        </button>
                                        <button type="button" onclick="document.getElementById('addressModal').classList.add('hidden')" class="px-8 py-4 text-gray-500 font-bold hover:bg-gray-50 rounded-2xl transition-all">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

        </div>
    </div>
</div>

<style>
    .tab-btn.active {
        background: white !important;
        color: #e8353b !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .tab-btn.active span, .tab-btn.active i {
        color: #e8353b !important;
    }
    .tab-content {
        animation: fadeIn 0.4s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    function switchTab(tabId) {
        // Update URL without reloading
        const newUrl = window.location.pathname + '?tab=' + tabId;
        window.history.pushState({path: newUrl}, '', newUrl);

        // Hide all contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remove active class from all buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // Show selected content
        const targetContent = document.getElementById('tab-' + tabId);
        if (targetContent) {
            targetContent.classList.remove('hidden');
        }
        
        // Add active class to clicked button
        const targetBtn = document.querySelector(`[data-tab="${tabId}"]`);
        if (targetBtn) {
            targetBtn.classList.add('active');
        }
    }

    // Handle initial tab from URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if (tab) {
            switchTab(tab);
        }
    });

    // Update Time
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        const strTime = (hours < 10 ? '0' + hours : hours) + ':' + minutes + ':' + seconds + ' ' + ampm;
        const currentTime = document.getElementById('current-time');
        if (currentTime) {
            currentTime.textContent = strTime;
        }
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Set Greeting
    const hour = new Date().getHours();
    const greeting = hour < 12 ? "Good morning!" : hour < 18 ? "Good afternoon!" : "Good evening!";
    document.getElementById('greeting').textContent = greeting;
</script>
@endsection
