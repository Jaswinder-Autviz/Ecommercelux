<div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
    <form action="{{ $action }}" method="POST" class="space-y-6">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $affiliate?->name) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $affiliate?->email) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $affiliate?->phone) }}" class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Social Media URL</label>
                <input type="url" name="social_media_url" value="{{ old('social_media_url', $affiliate?->social_media_url) }}" placeholder="https://www.instagram.com/username" class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                @error('social_media_url') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Password {{ $affiliate ? '(leave blank to keep)' : '' }}</label>
                <input type="password" name="password" {{ $affiliate ? '' : 'required' }} class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Coupon Code</label>
                <input type="text" name="coupon_code" value="{{ old('coupon_code', $affiliate?->coupon_code) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-bold uppercase tracking-widest outline-none transition-all">
                @error('coupon_code') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Status</label>
                <select name="status" class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                    @foreach(['pending', 'approved', 'rejected'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $affiliate?->status ?? 'pending') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Commission Type</label>
                <select name="commission_type" class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                    <option value="percentage" @selected(old('commission_type', $affiliate?->commission_type ?? 'percentage') === 'percentage')>Percentage</option>
                    <option value="fixed" @selected(old('commission_type', $affiliate?->commission_type) === 'fixed')>Fixed</option>
                </select>
                @error('commission_type') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Commission Value</label>
                <input type="number" step="0.01" min="0" name="commission_value" value="{{ old('commission_value', $affiliate?->commission_value ?? 0) }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all">
                @error('commission_value') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <button class="flex-1 rounded-xl bg-primary py-3 font-bold text-white shadow-lg shadow-primary/20 transition-all hover:scale-[1.02]">Save Affiliator</button>
            <a href="{{ route('admin.affiliates.index') }}" class="flex-1 rounded-xl bg-gray-100 py-3 text-center font-bold text-gray-600 transition-all hover:bg-gray-200">Cancel</a>
        </div>
    </form>
</div>
