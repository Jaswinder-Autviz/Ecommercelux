<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Hustler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(231, 19, 24, 0.18), transparent 34rem),
                linear-gradient(135deg, #1f2021 0%, #292b2c 46%, #121314 100%);
        }

        .login-shell {
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.32);
        }

        .brand-panel {
            background:
                linear-gradient(145deg, rgba(231, 19, 24, 0.92), rgba(152, 10, 14, 0.96)),
                url("{{ asset('assets/images/logo/Huslterlogo.png') }}");
            background-size: cover;
            background-position: center;
        }

        .field-focus:focus {
            box-shadow: 0 0 0 4px rgba(231, 19, 24, 0.12);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8">
    <main class="w-full max-w-5xl login-shell overflow-hidden rounded-[28px] bg-white">
        <div class="grid min-h-[620px] lg:grid-cols-[1.05fr_0.95fr]">
            <section class="brand-panel relative hidden overflow-hidden p-10 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="absolute inset-0 bg-dark/35"></div>
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-3 rounded-full bg-white/12 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] backdrop-blur">
                        <span class="h-2 w-2 rounded-full bg-white"></span>
                        Admin Panel
                    </div>
                    <h1 class="mt-8 max-w-md text-5xl font-extrabold leading-tight tracking-tight">
                        Control your Hustler store with confidence.
                    </h1>
                    <p class="mt-5 max-w-sm text-sm font-medium leading-6 text-white/78">
                        Manage products, categories, customers, orders, and reels from one focused dashboard.
                    </p>
                </div>

                <div class="relative z-10 grid grid-cols-3 gap-3">
                    <div class="rounded-2xl border border-white/14 bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-extrabold">24/7</p>
                        <p class="mt-1 text-[11px] font-semibold uppercase tracking-widest text-white/65">Access</p>
                    </div>
                    <div class="rounded-2xl border border-white/14 bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-extrabold">Live</p>
                        <p class="mt-1 text-[11px] font-semibold uppercase tracking-widest text-white/65">Orders</p>
                    </div>
                    <div class="rounded-2xl border border-white/14 bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-extrabold">Fast</p>
                        <p class="mt-1 text-[11px] font-semibold uppercase tracking-widest text-white/65">Updates</p>
                    </div>
                </div>
            </section>

            <section class="flex items-center justify-center bg-white px-5 py-10 sm:px-8 lg:px-12">
                <div class="w-full max-w-md">
                    <div class="mb-8">
                        <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-3">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary text-lg font-extrabold text-white shadow-lg shadow-primary/20">H</span>
                            <span>
                                <span class="block text-xl font-extrabold leading-none text-dark">Hustler</span>
                                <span class="mt-1 block text-[10px] font-bold uppercase tracking-[0.24em] text-gray-400">Admin Login</span>
                            </span>
                        </a>
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-950">Welcome back</h2>
                        <p class="mt-2 text-sm font-medium text-gray-500">Sign in to continue to your dashboard.</p>
                    </div>

                    @if(session('error'))
                        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-100 bg-red-50 p-4 text-sm font-semibold text-red-600">
                            <i class="fas fa-exclamation-circle mt-0.5"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="mb-2 block text-sm font-bold text-gray-700">Email Address</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="fas fa-envelope text-sm"></i>
                                </span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="field-focus w-full rounded-2xl border border-gray-200 bg-gray-50 py-4 pl-11 pr-4 text-sm font-semibold text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-primary focus:bg-white"
                                    placeholder="admin@hustler.com">
                            </div>
                            @error('email') <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <div class="mb-2 flex items-center justify-between gap-4">
                                <label class="block text-sm font-bold text-gray-700">Password</label>
                                <a href="#" class="text-xs font-bold text-primary hover:underline">Forgot Password?</a>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <i class="fas fa-lock text-sm"></i>
                                </span>
                                <input type="password" name="password" required
                                    class="field-focus w-full rounded-2xl border border-gray-200 bg-gray-50 py-4 pl-11 pr-4 text-sm font-semibold text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-primary focus:bg-white"
                                    placeholder="Enter your password">
                            </div>
                            @error('password') <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between gap-4 pt-1">
                            <label for="remember" class="flex cursor-pointer items-center gap-3 text-sm font-semibold text-gray-500">
                                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary/30">
                                Remember me
                            </label>
                            <span class="hidden text-xs font-bold uppercase tracking-widest text-gray-300 sm:inline">Secure Access</span>
                        </div>

                        <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-5 py-4 text-sm font-extrabold uppercase tracking-wider text-white shadow-xl shadow-primary/20 transition-all hover:bg-[#c91015] hover:-translate-y-0.5 active:translate-y-0">
                            Sign In
                            <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </form>



                    <p class="mt-6 text-center text-xs font-semibold text-gray-400">
                        &copy; 2026 Hustler eCommerce. All rights reserved.
                    </p>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
