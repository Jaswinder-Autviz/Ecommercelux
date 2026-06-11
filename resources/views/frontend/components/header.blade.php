{{-- Announcement Bar --}}
<!-- <div class="announcement-bar" id="announcementBar">
    <div class="announcement-inner">
        <div class="announcement-track">
            <div class="announcement-content">
                @for ($i = 0; $i < 4; $i++)
                    <span class="announcement-text">
                        ✦ Free shipping on orders over $150 &nbsp;&nbsp;|&nbsp;&nbsp; New Hustler tees every Friday &nbsp;&nbsp;|&nbsp;&nbsp; Use code <strong>HUSTLER10</strong> for 10% off
                    </span>
                @endfor
            </div>
        </div>
        <button class="announcement-close" id="closeAnnouncement" aria-label="Close announcement">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
    </div>
</div> -->

{{-- Main Header --}}
<header class="site-header" id="siteHeader">
    <div class="header-inner">

        {{-- Mobile Menu Toggle --}}
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Open menu" aria-expanded="false">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="site-logo">HUSTLER</a>

        {{-- Primary Navigation --}}
        <nav class="primary-nav" id="primaryNav" aria-label="Main navigation">
            <ul class="nav-list">

                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>

                <li class="nav-item {{ request()->routeIs('shop*') ? 'active' : '' }}">
                    <a href="{{ route('shop') }}" class="nav-link">Shop</a>
                </li>

                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                </li>

                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
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
                <div class="relative group">
                    <button class="action-btn account-btn flex items-center space-x-1" aria-label="Account">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="6" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M2 18c0-4 3.6-7 8-7s8 3 8 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        <span class="text-xs font-medium hidden md:block">{{ Auth::guard('customer')->user()->name ?? 'Account' }}</span>
                    </button>
                    {{-- Dropdown --}}
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="p-4 border-b border-gray-50">
                            <p class="text-xs text-gray-400">Welcome,</p>
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::guard('customer')->user()->name ?? Auth::guard('customer')->user()->phone }}</p>
                        </div>
                        <ul class="p-2">
                            <li><a href="{{ route('customer.account') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-all"><i class="far fa-user w-5"></i> My Account</a></li>
                            <li><a href="{{ route('customer.account') }}?tab=orders" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-all"><i class="fas fa-shopping-bag w-5"></i> My Orders</a></li>
                            <li><a href="{{ route('customer.account') }}?tab=address" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-all"><i class="far fa-address-card w-5"></i> Addresses</a></li>
                            <li class="border-t border-gray-50 mt-2 pt-2">
                                <form action="{{ route('customer.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-500 hover:bg-red-50 rounded-lg transition-all"><i class="fas fa-sign-out-alt w-5"></i> Logout</button>
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
                <input type="search" name="q" class="search-input" placeholder="Search for products, brands..." autocomplete="off" id="searchInput">
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
        <span class="mobile-logo">HUSTLER</span>
        <button class="mobile-close" id="mobileClose" aria-label="Close menu">
            <svg width="20" height="20" viewBox="0 0 14 14" fill="none"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
    </div>
    <ul class="mobile-nav-list">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('shop') }}" class="{{ request()->routeIs('shop*') ? 'active' : '' }}">Shop</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
        @if(Auth::guard('customer')->check())
            <li><a href="{{ route('customer.account') }}" class="{{ request()->routeIs('customer.account') ? 'active' : '' }}">My Account</a></li>
            <li><a href="{{ route('customer.orders') }}">My Orders</a></li>
        @else
            <li><button class="openLoginModalTrigger w-full text-left" style="color: inherit;">Account</button></li>
        @endif
        <li><a href="{{ route('wishlist') }}" class="{{ request()->routeIs('wishlist') ? 'active' : '' }}">Wishlist</a></li>
        <li><a href="{{ route('cart') }}" class="{{ request()->routeIs('cart') ? 'active' : '' }}">Cart</a></li>
    </ul>
</nav>
