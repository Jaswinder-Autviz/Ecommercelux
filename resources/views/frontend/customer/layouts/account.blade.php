@extends('frontend.layouts.app')

@section('title', 'My Account - LuxeStore')

@section('content')
<div class="min-h-screen bg-gray-50 pt-32 pb-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- Sidebar --}}
            <aside class="w-full lg:w-80 flex-shrink-0">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    {{-- User Summary --}}
                    <div class="p-8 bg-gray-900 text-gray-400 flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary/20 flex items-center justify-center text-primary border border-primary/30 overflow-hidden">
                            @if(Auth::guard('customer')->user()->profile_image)
                                <img src="{{ asset('assets/images/customers/' . Auth::guard('customer')->user()->profile_image) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-2xl"></i>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Hello,</p>
                            <h3 class="text-lg font-bold truncate w-40">{{ Auth::guard('customer')->user()->name ?? 'Guest' }}</h3>
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <nav class="p-4">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('customer.account') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('customer.account') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="fas fa-th-large w-5"></i>
                                    <span>Overview</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('customer.orders') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="fas fa-shopping-bag w-5"></i>
                                    <span>My Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('customer.profile') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="far fa-user w-5"></i>
                                    <span>Profile Information</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.addresses') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all {{ Request::routeIs('customer.addresses') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <i class="far fa-address-card w-5"></i>
                                    <span>Saved Addresses</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('wishlist') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-gray-600 hover:bg-gray-50">
                                    <i class="far fa-heart w-5"></i>
                                    <span>Wishlist</span>
                                </a>
                            </li>
                            <li class="pt-4 border-t border-gray-50 mt-4">
                                <form action="{{ route('customer.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-red-500 hover:bg-red-50 w-full text-left">
                                        <i class="fas fa-sign-out-alt w-5"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="flex-1">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 text-green-500 rounded-2xl border border-green-100 flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span class="text-sm font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('account_content')
            </main>

        </div>
    </div>
</div>
@endsection
