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
                        dark: '#172033',
                        ink: '#111214',
                        surface: '#f6f7f9',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary: #e71318;
            --primary-dark: #b90f13;
            --primary-soft: rgba(231, 19, 24, 0.1);
            --dark: #172033;
            --dark-2: #202a44;
            --ink: #111214;
            --muted: #6b7280;
            --surface: #f5f6fa;
            --sidebar: #172033;
            --sidebar-soft: rgba(255, 255, 255, 0.08);
            --line: #e7eaf0;
            --sidebar-line: rgba(255, 255, 255, 0.1);
        }

        * { letter-spacing: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            color: var(--ink);
            background:
                radial-gradient(circle at top right, rgba(231, 19, 24, 0.055), transparent 25rem),
                radial-gradient(circle at bottom left, rgba(23, 32, 51, 0.06), transparent 24rem),
                linear-gradient(180deg, #fbfcff 0%, var(--surface) 100%);
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 256px;
            height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(231, 19, 24, 0.18), transparent 17rem),
                linear-gradient(160deg, var(--dark-2) 0%, var(--sidebar) 52%, #0f1727 100%);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
            border-right: 1px solid var(--sidebar-line);
            box-shadow: 18px 0 54px rgba(15, 23, 39, 0.22);
        }

        .admin-sidebar.open { transform: translateX(0); }

        @media (min-width: 1024px) {
            .admin-sidebar { transform: translateX(0); }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 39, 0.62);
            backdrop-filter: blur(4px);
            z-index: 999;
        }

        .sidebar-overlay.show { display: block; }

        .admin-header {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            height: 70px;
            background: rgba(255, 253, 251, 0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
            z-index: 998;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            transition: left 0.3s ease;
            box-shadow: 0 10px 30px rgba(120, 87, 87, 0.05);
        }

        @media (min-width: 1024px) {
            .admin-header { left: 256px; }
        }

        .admin-main {
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            padding: 34px 28px;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 1024px) {
            .admin-main { margin-left: 256px; }
        }

        @media (max-width: 640px) {
            .admin-main { padding: 20px 16px; }
            .admin-header { padding: 0 16px; }
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            color: rgba(255, 255, 255, 0.74);
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.22s ease;
            border: 1px solid transparent;
            cursor: pointer;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .sidebar-link i {
            color: rgba(255, 255, 255, 0.48);
            transition: color 0.22s ease, transform 0.22s ease;
        }

        .sidebar-link:hover {
            background: var(--sidebar-soft);
            color: #fff;
            transform: translateX(2px);
        }

        .sidebar-link:hover i { color: #fff; }

        .sidebar-link.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border-color: rgba(231, 19, 24, 0.12);
            box-shadow: 0 14px 30px rgba(231, 19, 24, 0.18);
        }

        .sidebar-link.active i { color: #fff; }

        .text-primary { color: var(--primary)!important; }
        .bg-primary { background-color: var(--primary)!important; }
        .border-primary { border-color: var(--primary)!important; }
        .shadow-primary\/20 { --tw-shadow-color: rgba(231, 19, 24, 0.2)!important; }

        .bg-primary,
        button.bg-primary,
        a.bg-primary {
            color: #fff!important;
        }

        .bg-primary:hover,
        button.bg-primary:hover,
        a.bg-primary:hover {
            background-color: var(--primary-dark)!important;
        }

        .stat-card {
            border-color: var(--line)!important;
            box-shadow: 0 12px 36px rgba(17, 18, 20, 0.05);
        }

        .stat-card:hover {
            border-color: rgba(231, 19, 24, 0.16)!important;
            box-shadow: 0 20px 48px rgba(17, 18, 20, 0.09);
        }

        .stat-card:hover .stat-icon { transform: scale(1.08) rotate(4deg); }

        input, select, textarea {
            accent-color: var(--primary);
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary)!important;
            box-shadow: 0 0 0 4px rgba(231, 19, 24, 0.1)!important;
        }

        ::selection {
            background: rgba(231, 19, 24, 0.16);
            color: var(--ink);
        }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 4px; }
    </style>
    @stack('styles')
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="admin-sidebar" id="adminSidebar">
        <div class="p-6 border-b border-white/10 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-primary text-lg font-extrabold text-white shadow-lg shadow-primary/20">
                    H
                </span>
                <span>
                    <span class="block text-xl font-extrabold leading-none text-white">Hustler</span>
                    <span class="mt-1 block text-[10px] font-bold uppercase tracking-[0.22em] text-white/45">Admin Panel</span>
                </span>
            </a>

            <button id="closeSidebar" class="lg:hidden h-9 w-9 rounded-xl text-white/60 hover:bg-white/10 hover:text-white transition-all">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">
            <p class="px-3 mb-2 mt-2 text-[10px] font-extrabold uppercase tracking-[0.2em] text-white/35">Main Menu</p>

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
            <a href="{{ route('admin.affiliates.index') }}" class="sidebar-link {{ Request::is('admin/affiliates*') ? 'active' : '' }}">
                <i class="fas fa-handshake w-5 text-sm"></i>
                <span>Affiliators</span>
            </a>
            <a href="{{ route('admin.affiliate-withdrawals.index') }}" class="sidebar-link {{ Request::is('admin/affiliate-withdrawals*') ? 'active' : '' }}">
                <i class="fas fa-wallet w-5 text-sm"></i>
                <span>Affiliate Withdrawals</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-star w-5 text-sm"></i>
                <span>Reviews</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-ticket-alt w-5 text-sm"></i>
                <span>Coupons</span>
            </a>

            <p class="px-3 mb-2 mt-6 text-[10px] font-extrabold uppercase tracking-[0.2em] text-white/35">System</p>
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

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-3">
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-white font-extrabold text-sm flex-shrink-0 bg-primary shadow-lg shadow-primary/20">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-extrabold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-white/40">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <header class="admin-header">
        <div class="flex items-center gap-4">
            <button id="openSidebar" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-2xl bg-white text-gray-700 border border-gray-100 shadow-sm hover:text-primary transition-all">
                <i class="fas fa-bars"></i>
            </button>
            <div class="relative hidden md:block">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                    <i class="fas fa-search text-xs"></i>
                </span>
                <input type="text" placeholder="Search dashboard..."
                    class="pl-10 pr-4 py-2.5 bg-white border border-gray-100 rounded-2xl text-sm font-semibold outline-none w-72 shadow-sm transition-all">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button class="md:hidden w-10 h-10 flex items-center justify-center rounded-2xl bg-white text-gray-500 border border-gray-100 shadow-sm hover:text-primary transition-all">
                <i class="fas fa-search text-xs"></i>
            </button>
            <button class="relative w-10 h-10 flex items-center justify-center rounded-2xl bg-white text-gray-500 border border-gray-100 shadow-sm hover:text-primary transition-all">
                <i class="far fa-bell"></i>
                <span class="absolute top-2 right-2 w-2.5 h-2.5 rounded-full border-2 border-white bg-primary"></span>
            </button>
            <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white py-1.5 pl-3 pr-1.5 shadow-sm">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-extrabold text-gray-950 leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Super Admin</p>
                </div>
                <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-white font-extrabold text-sm bg-primary">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <main class="admin-main">
        @if(session('success'))
            <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl border border-red-100 flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle"></i>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-white text-gray-700 rounded-2xl border border-gray-100 flex items-center gap-3 shadow-sm">
                <i class="fas fa-exclamation-circle text-primary"></i>
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
