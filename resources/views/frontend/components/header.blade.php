@php
    $customer = Auth::guard('customer')->user();
    $customerName = $customer?->name ?: $customer?->phone ?: 'Account';
    $customerInitial = strtoupper(substr(trim($customerName), 0, 1));
@endphp

{{-- Announcement Bar --}}
<div class="announcement-bar" id="announcementBar">
    <div class="announcement-inner container">
        <div class="announcement-track">
            <div class="announcement-content">
                <span class="announcement-text">
                    Handcrafted. Personalized. Delivered across India
                </span>
            </div>
        </div>
    </div>
</div>

{{-- Main Header --}}
<header class="site-header" id="siteHeader">
    <div class="header-inner container">

        {{-- Mobile Menu Toggle --}}
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Open menu" aria-expanded="false">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="site-logo" aria-label="Hustler home">
            <img src="{{ asset('assets/images/logo/hustler-logo.png') }}" alt="Hustler Posters">
        </a>

        {{-- Primary Navigation --}}
        <nav class="primary-nav" id="primaryNav" aria-label="Main navigation">
            <ul class="nav-list">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ request()->routeIs('shop*') ? 'active' : '' }}">
                    <a href="{{ route('shop') }}" class="nav-link">Shop</a>
                </li>
                <li class="nav-item {{ request()->routeIs('shop*') ? '' : '' }}">
                    <a href="{{ route('shop') }}" class="nav-link">New Arrivals</a>
                </li>
                <li class="nav-item {{ request()->routeIs('shop*') ? '' : '' }}">
                    <a href="{{ route('shop') }}" class="nav-link">Best Sellers</a>
                </li>
                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="nav-link">About Us</a>
                </li>
            </ul>
        </nav>

        {{-- Header Actions --}}
        <div class="header-actions">

            {{-- Search --}}
            <button class="action-btn search-toggle" id="searchToggle" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="8.5" cy="8.5" r="6.5" stroke="currentColor" stroke-width="1.5"/><path d="M13.5 13.5L18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </button>

            {{-- Wishlist --}}
            <a href="{{ route('wishlist') }}" class="action-btn wishlist-btn {{ request()->routeIs('wishlist') ? 'active' : '' }}" aria-label="Wishlist" style="position:relative">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 17s-7-4.5-7-9a4 4 0 018 0 4 4 0 018 0c0 4.5-7 9-7 9z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                <span class="cart-badge" id="wishlistBadge" style="display:none">0</span>
            </a>

            {{-- Cart --}}
            <a href="{{ route('cart') }}" class="action-btn cart-btn {{ request()->routeIs('cart') ? 'active' : '' }}" aria-label="Cart">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M2 2h2l2.5 10h9l2-7H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="8.5" cy="16.5" r="1.5" fill="currentColor"/><circle cx="14.5" cy="16.5" r="1.5" fill="currentColor"/></svg>
                <span class="cart-badge" id="cartBadge">0</span>
            </a>

            {{-- Account --}}
            @if(Auth::guard('customer')->check())
                <div class="account-menu group">
                    <button class="action-btn account-btn account-avatar-btn" aria-label="Account">
                        <span class="account-avatar">{{ $customerInitial }}</span>
                    </button>
                    <div class="account-dropdown">
                        <div class="account-dropdown-head">
                            <span class="account-avatar account-avatar-lg">{{ $customerInitial }}</span>
                            <div>
                                <p class="account-welcome">Welcome back</p>
                                <p class="account-name">{{ $customerName }}</p>
                            </div>
                        </div>
                        <ul class="account-dropdown-list">
                            <li><a href="{{ route('customer.account') }}"><i class="far fa-user"></i> My Account</a></li>
                            <li><a href="{{ route('customer.account') }}?tab=orders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
                            <li><a href="{{ route('customer.account') }}?tab=address"><i class="far fa-address-card"></i> Addresses</a></li>
                            <li class="account-logout-row">
                                <form action="{{ route('customer.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <button class="action-btn account-btn openLoginModalTrigger" aria-label="Account">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="6" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </button>
            @endif

        </div>
    </div>

    {{-- Search Overlay --}}
    <div class="search-overlay" id="searchOverlay">
        <div class="search-overlay-inner container">
            <form action="{{ route('shop') }}" method="GET" class="search-form" role="search">
                <svg width="22" height="22" viewBox="0 0 20 20" fill="none"><circle cx="8.5" cy="8.5" r="6.5" stroke="currentColor" stroke-width="1.5"/><path d="M13.5 13.5L18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                <input type="search" name="q" class="search-input" placeholder="Search posters, styles, themes..." autocomplete="off" id="searchInput">
                <button type="button" class="search-close" id="searchClose" aria-label="Close search">
                    <svg width="18" height="18" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </button>
            </form>
        </div>
    </div>
</header>

{{-- Mobile Drawer --}}
<div class="mobile-overlay" id="mobileOverlay"></div>
<nav class="mobile-nav" id="mobileNav" aria-label="Mobile navigation">
    <div class="mobile-nav-header">
        <span class="mobile-logo">
            <img src="{{ asset('assets/images/logo/hustler-logo.png') }}" alt="Hustler Posters">
        </span>
        <button class="mobile-close" id="mobileClose" aria-label="Close menu">
            <svg width="20" height="20" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
    </div>
    @if(Auth::guard('customer')->check())
        <div class="mobile-account-card">
            <span class="account-avatar account-avatar-lg">{{ $customerInitial }}</span>
            <div>
                <p>Signed in as</p>
                <strong>{{ $customerName }}</strong>
            </div>
        </div>
    @else
        <div class="mobile-account-card mobile-account-card-guest">
            <span class="account-avatar account-avatar-lg"><i class="far fa-user"></i></span>
            <div>
                <p>Welcome to Hustler</p>
                <strong>Sign in for faster checkout</strong>
            </div>
        </div>
    @endif
    <ul class="mobile-nav-list">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('shop') }}" class="{{ request()->routeIs('shop*') ? 'active' : '' }}">Shop All Posters</a></li>
        <li><a href="{{ route('shop') }}">New Arrivals</a></li>
        <li><a href="{{ route('shop') }}">Best Sellers</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
        <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
        @if(Auth::guard('customer')->check())
            <li><a href="{{ route('customer.account') }}">My Account</a></li>
            <li><a href="{{ route('customer.account') }}?tab=orders">My Orders</a></li>
        @else
            <li><button class="openLoginModalTrigger mobile-nav-button">Sign In</button></li>
        @endif
        <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
        <li><a href="{{ route('cart') }}">Cart</a></li>
    </ul>
</nav>
