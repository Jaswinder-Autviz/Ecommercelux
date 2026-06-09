<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hustler Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e8353b',
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gradient min-h-screen flex items-center justify-center p-6">
    <div class="glass w-full max-w-md p-8 rounded-3xl shadow-2xl space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Create Account</h1>
            <p class="text-gray-500 mt-2">Join Hustler to manage your shop</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-500 p-4 rounded-xl text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        placeholder="John Doe">
                </div>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        placeholder="admin@hustler.com">
                </div>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" required
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        placeholder="••••••••">
                </div>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password_confirmation" required
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl transition-all shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98]">
                Create Account
            </button>
        </form>

        <p class="text-center text-sm text-gray-500">
            Already have an account? 
            <a href="{{ route('admin.login') }}" class="text-primary font-bold hover:underline">Sign In</a>
        </p>
    </div>
</body>
</html>
