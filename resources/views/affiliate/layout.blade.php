<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Affiliate Dashboard - Hustler')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#e71318', ink: '#111214' } } } }
    </script>
</head>
<body class="bg-gray-50 text-ink">
    <div class="min-h-screen md:flex">
        <aside class="bg-ink text-white md:w-64">
            <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">
                <a href="{{ route('affiliate.dashboard') }}" class="font-extrabold tracking-wide">HUSTLER Affiliate</a>
                <a href="{{ route('home') }}" class="text-xs font-bold uppercase tracking-widest text-white/50">Store</a>
            </div>
            <nav class="space-y-2 p-4">
                <a href="{{ route('affiliate.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('affiliate.dashboard') ? 'bg-primary text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('affiliate.redeem') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition-all {{ request()->routeIs('affiliate.redeem') ? 'bg-primary text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-wallet w-5"></i>
                    Redeem
                </a>
                <form action="{{ route('affiliate.logout') }}" method="POST">
                    @csrf
                    <button class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-bold text-white/75 transition-all hover:bg-white/10 hover:text-white">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>
        <main class="flex-1 p-5 md:p-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm font-bold text-green-700">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm font-bold text-red-700">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
