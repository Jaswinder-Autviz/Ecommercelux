<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Hustler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-gradient { background: linear-gradient(135deg, #111827 0%, #1a1a1a 100%); }
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-gradient min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <div class="glass rounded-2xl p-8 shadow-2xl">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-400 tracking-tighter mb-2">HUSTLER <span class="text-[#e8353b]">ADMIN</span></h1>
                <p class="text-gray-400 text-sm">Enter your credentials to access dashboard</p>
            </div>

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#e8353b]/50 focus:border-[#e8353b] transition-all" placeholder="admin@hustler.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-gray-300 text-sm font-medium">Password</label>
                        <a href="#" class="text-[#e8353b] text-xs hover:underline">Forgot Password?</a>
                    </div>
                    <input type="password" name="password" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#e8353b]/50 focus:border-[#e8353b] transition-all" placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-white/10 bg-white/5 text-[#e8353b] focus:ring-[#e8353b]/50">
                    <label for="remember" class="ml-2 text-gray-400 text-sm">Remember me for 30 days</label>
                </div>

                <button type="submit" class="w-full bg-[#e8353b] hover:bg-[#e63660] text-gray-400 font-bold py-3 rounded-xl transition-all shadow-lg shadow-[#e8353b]/20 transform hover:-translate-y-0.5 active:translate-y-0">
                    SIGN IN TO DASHBOARD
                </button>
            </form>
        </div>

        <p class="text-center text-gray-500 text-xs mt-8">
            &copy; 2026 Hustler eCommerce. All rights reserved.
        </p>
        <p class="text-center text-sm text-gray-500">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Sign Up</a>
        </p>
    </div>
</body>
</html>
