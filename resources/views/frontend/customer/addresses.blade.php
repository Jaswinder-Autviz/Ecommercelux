@extends('frontend.customer.layouts.account')

@section('account_content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">Saved Addresses</h2>
        <button onclick="document.getElementById('addressModal').classList.remove('hidden')" class="text-primary font-bold text-sm flex items-center hover:underline">
            <i class="fas fa-plus mr-2"></i> Add New Address
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($addresses as $address)
            <div class="bg-white p-6 rounded-3xl shadow-sm border {{ $address->is_default ? 'border-primary' : 'border-gray-100' }} relative group">
                @if($address->is_default)
                    <span class="absolute top-4 right-4 bg-primary text-gray-400 text-[10px] font-bold px-2 py-1 rounded-lg uppercase tracking-wider">Default</span>
                @endif
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 bg-gray-100 text-gray-500 text-[10px] font-bold uppercase rounded-lg">{{ $address->address_type }}</span>
                        <h4 class="font-bold text-gray-900">{{ $address->full_name }}</h4>
                    </div>
                    
                    <div class="text-sm text-gray-500 leading-relaxed">
                        <p>{{ $address->street_address }}</p>
                        <p>{{ $address->landmark ? $address->landmark . ', ' : '' }}{{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}</p>
                    </div>

                    <p class="text-sm font-bold text-gray-900"><i class="fas fa-phone-alt mr-2 text-gray-300"></i> {{ $address->mobile_number }}</p>

                    <div class="flex space-x-4 pt-2">
                        <button class="text-xs font-bold text-gray-400 hover:text-primary transition-all uppercase tracking-widest">Edit</button>
                        <button class="text-xs font-bold text-gray-400 hover:text-red-500 transition-all uppercase tracking-widest">Remove</button>
                        @if(!$address->is_default)
                            <button class="text-xs font-bold text-primary hover:underline transition-all uppercase tracking-widest">Set as Default</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 bg-white p-12 rounded-3xl border border-dashed border-gray-200 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="far fa-address-card text-2xl text-gray-200"></i>
                </div>
                <p class="text-gray-400">No addresses saved yet.</p>
                <button onclick="document.getElementById('addressModal').classList.remove('hidden')" class="mt-4 bg-primary text-gray-400 font-bold px-6 py-3 rounded-xl shadow-lg shadow-primary/20 transition-all">
                    Add Your First Address
                </button>
            </div>
        @endforelse
    </div>
</div>

{{-- Add Address Modal --}}
<div id="addressModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="this.parentElement.classList.add('hidden')"></div>
    <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden p-8 max-h-[90vh] overflow-y-auto">
        <h3 class="text-2xl font-bold text-gray-900 mb-8">Add New Address</h3>
        
        <form action="{{ route('customer.addresses.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="full_name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Mobile Number</label>
                <input type="text" name="mobile_number" required maxlength="10" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pincode</label>
                <input type="text" name="pincode" required maxlength="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">State</label>
                <input type="text" name="state" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">City</label>
                <input type="text" name="city" required class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Landmark (Optional)</label>
                <input type="text" name="landmark" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Street Address</label>
                <textarea name="street_address" required rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Address Type</label>
                <div class="flex space-x-4">
                    <label class="flex-1">
                        <input type="radio" name="address_type" value="home" checked class="hidden peer">
                        <div class="text-center py-3 rounded-xl border border-gray-100 bg-gray-50 peer-checked:bg-primary peer-checked:text-gray-400 peer-checked:border-primary cursor-pointer transition-all font-bold text-sm">Home</div>
                    </label>
                    <label class="flex-1">
                        <input type="radio" name="address_type" value="office" class="hidden peer">
                        <div class="text-center py-3 rounded-xl border border-gray-100 bg-gray-50 peer-checked:bg-primary peer-checked:text-gray-400 peer-checked:border-primary cursor-pointer transition-all font-bold text-sm">Office</div>
                    </label>
                </div>
            </div>

            <div class="md:col-span-2 flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-primary text-gray-400 font-bold py-4 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                    Save Address
                </button>
                <button type="button" onclick="document.getElementById('addressModal').classList.add('hidden')" class="px-8 py-4 text-gray-500 font-bold hover:bg-gray-50 rounded-2xl transition-all">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
