<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hustler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e71318',
                        dark: '#292b2c',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        /* ── Sidebar ── */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 256px;
            height: 100vh;
            background: #292b2c;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        .admin-sidebar.open { transform: translateX(0); }

        /* Desktop: always visible */
        @media (min-width: 1024px) {
            .admin-sidebar { transform: translateX(0); }
        }

        /* ── Overlay (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .sidebar-overlay.show { display: block; }

        /* ── Header ── */
        .admin-header {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            height: 70px;
            background: #fff;
            border-bottom: 1px solid #f3f4f6;
            z-index: 998;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            transition: left 0.3s ease;
        }
        @media (min-width: 1024px) {
            .admin-header { left: 256px; }
        }

        /* ── Main content ── */
        .admin-main {
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            padding: 32px 24px;
            transition: margin-left 0.3s ease;
        }
        @media (min-width: 1024px) {
            .admin-main { margin-left: 256px; }
        }
        @media (max-width: 640px) {
            .admin-main { padding: 20px 16px; }
        }

        /* ── Sidebar links ── */
        .sidebar-link {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; border-radius: 12px;
            color: rgba(255,255,255,0.85);
            text-decoration: none; font-size: 14px; font-weight: 500;
            transition: all 0.2s;
            border-right: 3px solid transparent;
            cursor: pointer; background: none; border-left: none; border-top: none; border-bottom: none;
            width: 100%; text-align: left;
        }
        .sidebar-link:hover { background: rgba(231,19,24,0.1); color: #fff; }
        .sidebar-link:hover i { color: #e71318; }
        .sidebar-link.active { background: rgba(231,19,24,0.15); color: #e71318; border-right: 3px solid #e71318; }
        .sidebar-link.active i { color: #e71318; }

        /* ── Accent ── */
        .text-primary { color: #e31837!important; }
        .bg-primary { background-color: #e31837!important; }
        .stat-card:hover .stat-icon { transform: scale(1.1) rotate(5deg); }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #e71318; border-radius: 4px; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="p-6 border-b border-white/10 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-white">
                    <span style="color:#e71318">Hustler</span>
                </h1>
                <p class="text-[10px] text-gray-500 mt-0.5 tracking-widest uppercase">Admin Panel</p>
            </div>
            <!-- Close btn (mobile) -->
            <button id="closeSidebar" class="lg:hidden text-gray-400 hover:text-white p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">
            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-600 px-3 mb-2 mt-2">Main Menu</p>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large w-5 text-sm"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ Request::is('admin/products*') ? 'active' : '' }}">
                <i class="fas fa-box w-5 text-sm"></i>
                <span>Products</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ Request::is('admin/orders*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag w-5 text-sm"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
                <i class="fas fa-tags w-5 text-sm"></i>
                <span>Categories</span>
            </a>
            <a href="{{ route('admin.customers.index') }}" class="sidebar-link {{ Request::is('admin/customers*') ? 'active' : '' }}">
                <i class="fas fa-users w-5 text-sm"></i>
                <span>Customers</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-star w-5 text-sm"></i>
                <span>Reviews</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-ticket-alt w-5 text-sm"></i>
                <span>Coupons</span>
            </a>

            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-600 px-3 mb-2 mt-6">System</p>
            <a href="#" class="sidebar-link">
                <i class="fas fa-cog w-5 text-sm"></i>
                <span>Settings</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link">
                    <i class="fas fa-sign-out-alt w-5 text-sm"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>

        <!-- User info -->
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 bg-white/5 p-3 rounded-2xl">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0" style="background:#e71318">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-500">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Top Header -->
    <header class="admin-header">
        <div class="flex items-center gap-4">
            <!-- Hamburger (mobile) -->
            <button id="openSidebar" class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-100 transition-all">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Search -->
            <div class="relative hidden md:block">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fas fa-search text-xs"></i>
                </span>
                <input type="text" placeholder="Search..."
                    class="pl-9 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-sm outline-none w-64 focus:border-red-200 transition-all">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <!-- Mobile search icon -->
            <button class="md:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-50 text-gray-500">
                <i class="fas fa-search text-xs"></i>
            </button>
            <!-- Bell -->
            <button class="relative w-9 h-9 flex items-center justify-center rounded-xl bg-gray-50 text-gray-500 hover:text-primary transition-all">
                <i class="far fa-bell"></i>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full border-2 border-white" style="background:#e71318"></span>
            </button>
            <!-- User -->
            <div class="flex items-center gap-2">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-900 leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-400">Super Admin</p>
                </div>
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-sm" style="background:#e71318">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="admin-main">
        @if(session('success'))
            <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl border border-red-100 flex items-center gap-3">
                <i class="fas fa-check-circle"></i>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-gray-50 text-gray-700 rounded-2xl border border-gray-200 flex items-center gap-3">
                <i class="fas fa-exclamation-circle" style="color:#e71318"></i>
                <span class="text-sm font-bold">{{ session('error') }}</span>
            </div>
        @endif

        @yield('admin_content')
    </main>

    <script>
        const sidebar  = document.getElementById('adminSidebar');
        const overlay  = document.getElementById('sidebarOverlay');
        const openBtn  = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }

        openBtn?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);
    </script>

    @stack('scripts')
</body>
</html>
