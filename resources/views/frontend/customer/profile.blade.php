@extends('frontend.customer.layouts.account')

@section('account_content')
<div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">Profile Information</h2>

    <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        {{-- Profile Image --}}
        <div class="flex items-center space-x-6">
            <div class="relative group">
                <div class="w-24 h-24 rounded-3xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden">
                    <img id="profilePreview" src="{{ $customer->profile_image ? asset('assets/images/customers/' . $customer->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($customer->name).'&background=ff3f6c&color=fff' }}" class="w-full h-full object-cover">
                </div>
                <label for="profile_image" class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary text-gray-400 rounded-xl flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 transition-all">
                    <i class="fas fa-camera text-xs"></i>
                    <input type="file" name="profile_image" id="profile_image" class="hidden" accept="image/*" onchange="previewImage(this)">
                </label>
            </div>
            <div>
                <h4 class="font-bold text-gray-900">Profile Photo</h4>
                <p class="text-xs text-gray-400 mt-1">PNG, JPG or JPEG. Max size 2MB</p>
            </div>
        </div>

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

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                <select name="gender" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $customer->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $customer->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $customer->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $customer->dob ? $customer->dob->format('Y-m-d') : '') }}" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                @error('dob') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
