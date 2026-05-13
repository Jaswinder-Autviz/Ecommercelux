@extends('admin.layouts.admin')

@section('admin_content')
<div class="max-w-xl space-y-6">

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.categories.index') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 text-gray-500 hover:bg-gray-200 transition-all">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Category</h1>
            <p class="text-sm text-gray-500">Update "{{ $category->name }}"</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-sm">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category Image</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-primary transition-all cursor-pointer" onclick="document.getElementById('editCategoryImage').click()">
                    @if($category->image)
                        <img id="editImagePreview"
                             src="{{ asset('assets/images/categories/' . $category->image) }}"
                             alt="{{ $category->name }}"
                             class="w-28 h-28 object-cover rounded-xl mx-auto mb-3">
                        <p class="text-xs text-gray-400">Click to change image</p>
                    @else
                        <img id="editImagePreview" src="" alt="" class="hidden w-28 h-28 object-cover rounded-xl mx-auto mb-3">
                        <div id="editUploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-400">Click to upload image</p>
                            <p class="text-xs text-gray-300 mt-1">JPG, PNG, WEBP — Max 2MB</p>
                        </div>
                    @endif
                    <input type="file" id="editCategoryImage" name="image" accept="image/*" class="hidden" onchange="previewEditImage(this)">
                </div>
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-primary text-white font-bold py-3 rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Save Changes
                </button>
                <a href="{{ route('admin.categories.index') }}"
                   class="flex-1 text-center bg-gray-100 text-gray-600 font-bold py-3 rounded-xl hover:bg-gray-200 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewEditImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('editImagePreview');
            const placeholder = document.getElementById('editUploadPlaceholder');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
