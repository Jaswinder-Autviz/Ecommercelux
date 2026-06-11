@extends('frontend.layouts.app')

@section('title', 'Affiliate Login - Hustler')

@section('content')
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-md px-4">
        <div class="bg-white p-8 shadow-sm ring-1 ring-gray-100">
            <h1 class="text-2xl font-extrabold text-gray-950">Affiliate Login</h1>
            <p class="mt-2 text-sm text-gray-500">Access your coupon performance and commission summary.</p>

            @if(session('success'))
                <div class="mt-5 rounded-xl bg-green-50 px-4 py-3 text-sm font-bold text-green-700">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mt-5 rounded-xl bg-red-50 px-4 py-3 text-sm font-bold text-red-700">{{ session('error') }}</div>
            @endif

            <form action="{{ route('affiliate.login.post') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Password</label>
                    <input type="password" name="password" required class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                    @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <button class="w-full bg-gray-950 px-5 py-3 text-sm font-extrabold uppercase tracking-widest text-white transition-all hover:bg-primary">Login</button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                New here? <a href="{{ route('affiliate.register') }}" class="font-bold text-primary">Become an Affiliate</a>
            </p>
        </div>
    </div>
</section>
@endsection
