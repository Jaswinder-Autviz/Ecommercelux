@extends('frontend.layouts.app')

@section('title', 'Become an Affiliate - Hustler')

@section('content')
<section class="bg-gray-50 py-16">
    <div class="mx-auto grid max-w-5xl gap-8 px-4 md:grid-cols-[1fr_1.1fr]">
        <div class="self-center">
            <p class="text-xs font-extrabold uppercase tracking-[0.25em] text-primary">Affiliate Program</p>
            <h1 class="mt-3 text-4xl font-black text-gray-950">Earn with every Hustler order you bring in.</h1>
            <p class="mt-4 text-sm leading-7 text-gray-600">Apply for a unique coupon code. Once admin approves your account, you can login and track orders, sales, and commission from your dashboard.</p>
            <a href="{{ route('affiliate.login') }}" class="mt-6 inline-flex text-sm font-bold text-gray-950 underline">Already approved? Login</a>
        </div>

        <div class="bg-white p-8 shadow-sm ring-1 ring-gray-100">
            <h2 class="text-xl font-extrabold text-gray-950">Affiliate Registration</h2>
            @if(session('error'))
                <div class="mt-5 rounded-xl bg-red-50 px-4 py-3 text-sm font-bold text-red-700">{{ session('error') }}</div>
            @endif
            <form action="{{ route('affiliate.register.post') }}" method="POST" class="mt-6 grid gap-5">
                @csrf
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                        @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Social Media URL</label>
                    <input type="url" name="social_media_url" value="{{ old('social_media_url') }}" required placeholder="https://www.instagram.com/yourprofile" class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                    <p class="mt-2 text-xs font-semibold text-gray-400">Instagram, Facebook, YouTube, or any active profile link.</p>
                    @error('social_media_url') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Password</label>
                        <input type="password" name="password" required class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                        @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-gray-500">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="w-full border border-gray-200 px-4 py-3 text-sm outline-none focus:border-gray-950">
                    </div>
                </div>
                <button class="bg-gray-950 px-5 py-3 text-sm font-extrabold uppercase tracking-widest text-white transition-all hover:bg-primary">Submit Application</button>
            </form>
        </div>
    </div>
</section>
@endsection
