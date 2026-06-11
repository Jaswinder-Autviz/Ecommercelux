@extends('frontend.customer.layouts.account')

@section('account_content')
<div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">Profile Information</h2>

    <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                    placeholder="Enter your name">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $customer->email) }}" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                    placeholder="Enter your email">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Mobile Number</label>
                <input type="text" value="{{ $customer->phone }}" readonly 
                    class="w-full px-4 py-3 bg-gray-100 border border-gray-100 rounded-xl text-gray-400 cursor-not-allowed outline-none">
                <p class="text-[10px] text-gray-400 mt-1">Mobile number cannot be changed</p>
            </div>

        </div>

        <div class="flex space-x-4 pt-4">
            <button type="submit" class="bg-primary text-gray-400 font-bold px-8 py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Save Changes
            </button>
            <a href="{{ route('customer.account') }}" class="px-8 py-4 text-gray-500 font-bold hover:bg-gray-50 rounded-2xl transition-all">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
