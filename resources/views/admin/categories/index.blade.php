@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
            <p class="text-sm text-gray-500">Manage your product categories.</p>
        </div>
        <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')"
            class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
            <i class="fas fa-plus mr-2"></i> Add Category
        </button>
    </div>

    @if(session('error'))
        <div class="p-4 bg-red-50 text-red-600 rounded-2xl border border-red-100 flex items-center gap-3">
            <i class="fas fa-exclamation-triangle"></i>
            <span class="text-sm font-bold">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[11px] uppercase tracking-wider text-gray-400 font-bold">
                        <th class="px-6 py-4">Image</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Products</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="px-6 py-4">
                            @if($category->image)
                                <img src="{{ asset('assets/images/categories/' . $category->image) }}"
                                     alt="{{ $category->name }}"
                                     class="w-12 h-12 rounded-xl object-cover border border-gray-100">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                                {{ $category->products_count }} Products
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-100 transition-all">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                      onsubmit="return confirmDelete(event, '{{ $category->name }}', {{ $category->products_count }})">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-400 hover:bg-red-100 transition-all">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">No categories found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-50">
            {{ $categories->links() }}
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="hidden fixed inset-0  backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Add New Category</h3>
            <button onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-sm"
                    placeholder="e.g. Abstract">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category Image</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-primary transition-all cursor-pointer" onclick="document.getElementById('categoryImage').click()">
                    <img id="imagePreview" src="" alt="" class="hidden w-24 h-24 object-cover rounded-xl mx-auto mb-3">
                    <div id="uploadPlaceholder">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-400">Click to upload image</p>
                        <p class="text-xs text-gray-300 mt-1">JPG, PNG, WEBP — Max 2MB</p>
                    </div>
                    <input type="file" id="categoryImage" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                </div>
            </div>
            <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Create Category
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('uploadPlaceholder');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function confirmDelete(e, name, productCount) {
    e.preventDefault();
    if (productCount > 0) {
        alert(`⚠️ Cannot delete "${name}"!\n\nThis category has ${productCount} product(s) assigned to it.\n\nPlease go to Products and reassign or delete those products first, then try again.`);
        return false;
    }
    if (confirm(`Are you sure you want to delete "${name}"?`)) {
        e.target.submit();
    }
    return false;
}
</script>
@endpush
@endsection
