@extends('frontend.layouts.app')

@section('title', 'My Account - LuxeStore')

@section('content')
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
                            <p class="text-xs text-gray-400/70 mt-1 flex items-center">
                                <i class="far fa-clock mr-1"></i> <span id="current-time">04:58:50 PM</span>
                            </p>
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
                                    <span class="bg-white/20 w-5 h-5 flex items-center justify-center text-[10px] rounded-md font-bold">1</span>
                                </button>
                            </li>
                            <li>
                                <button onclick="switchTab('address')" class="tab-btn w-full flex items-center justify-between px-5 py-4 rounded-2xl transition-all hover:bg-white/10 group" data-tab="address">
                                    <div class="flex items-center space-x-4">
                                        <i class="fas fa-map-marker-alt text-lg"></i>
                                        <span class="font-bold">Delivery address</span>
                                    </div>
                                    <span class="bg-white/20 w-5 h-5 flex items-center justify-center text-[10px] rounded-md font-bold">1</span>
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
                    
                    {{-- Profile Tab --}}
                    <div id="tab-profile" class="tab-content space-y-10">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-800">Profile Details</h2>
                            <button class="p-2 text-gray-400 hover:text-primary transition-all">
                                <i class="far fa-edit text-xl"></i>
                            </button>
                        </div>

                        <form class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">First name</label>
                                <input type="text" value="{{ explode(' ', Auth::guard('customer')->user()->name ?? 'Jaswinder Singh')[0] }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">Last name</label>
                                <input type="text" value="{{ explode(' ', Auth::guard('customer')->user()->name ?? 'Singh')[1] ?? '' }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">Email</label>
                                <input type="email" value="{{ Auth::guard('customer')->user()->email ?? 'jaswinderhunjan15@gmail.com' }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">Contact number</label>
                                <input type="text" value="+91 {{ Auth::guard('customer')->user()->phone ?? '9915541237' }}" class="w-full px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-gray-800">
                            </div>
                            
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-600 ml-1">Birthdate</label>
                                <div class="flex gap-4">
                                    <input type="text" placeholder="DD" class="w-24 px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl text-center font-medium">
                                    <input type="text" placeholder="MM" class="w-24 px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl text-center font-medium">
                                    <input type="text" placeholder="YYYY" class="flex-1 px-6 py-4 bg-[#f0f4f9] border-none rounded-2xl font-medium">
                                </div>
                            </div>

                            <div class="md:col-span-2 space-y-4">
                                <label class="text-sm font-bold text-gray-600 ml-1">Gender</label>
                                <div class="flex items-center gap-8">
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="radio" name="gender" class="w-5 h-5 text-primary focus:ring-primary/20 bg-[#f0f4f9] border-none">
                                        <span class="font-bold text-gray-700 group-hover:text-primary transition-all">Male</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="radio" name="gender" class="w-5 h-5 text-primary focus:ring-primary/20 bg-[#f0f4f9] border-none">
                                        <span class="font-bold text-gray-700 group-hover:text-primary transition-all">Female</span>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                        <input type="radio" name="gender" class="w-5 h-5 text-primary focus:ring-primary/20 bg-[#f0f4f9] border-none">
                                        <span class="font-bold text-gray-700 group-hover:text-primary transition-all">Other</span>
                                    </label>
                                </div>
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
                        <div class="space-y-4">
                            <div class="p-6 bg-[#f0f4f9] rounded-[24px] flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-primary shadow-sm">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">Order #LX-5520</p>
                                        <p class="text-xs text-gray-500">Placed on 10 May, 2026</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-primary">₹2,499.00</p>
                                    <span class="text-[10px] font-bold uppercase text-green-500">Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Address Tab --}}
                    <div id="tab-address" class="tab-content hidden space-y-6">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-800">Saved Addresses</h2>
                            <button class="bg-primary text-gray-400 px-5 py-2 rounded-xl text-xs font-bold shadow-lg shadow-primary/20">Add New</button>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="p-6 border-2 border-primary rounded-[24px] bg-primary/5 relative">
                                <span class="absolute top-4 right-4 bg-primary text-gray-400 text-[10px] px-2 py-0.5 rounded-md font-bold uppercase">Default</span>
                                <h4 class="font-bold text-gray-800 mb-2">Home</h4>
                                <p class="text-sm text-gray-500 leading-relaxed">
                                    #123, Luxury Heights, Fashion Street,<br>
                                    Model Town, Ludhiana, Punjab - 141001
                                </p>
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
        document.getElementById('current-time').textContent = strTime;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Set Greeting
    const hour = new Date().getHours();
    const greeting = hour < 12 ? "Good morning!" : hour < 18 ? "Good afternoon!" : "Good evening!";
    document.getElementById('greeting').textContent = greeting;
</script>
@endsection
