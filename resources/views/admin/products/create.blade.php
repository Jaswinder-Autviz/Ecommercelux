@extends('admin.layouts.admin')

@push('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable { min-height: 200px; border-radius: 0 0 12px 12px !important; }
    .drop-zone { border: 2px dashed #e5e7eb; transition: all 0.3s; }
    .drop-zone--over { border-color: #e8353b; background: rgba(255, 63, 108, 0.05); }
</style>
@endpush

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Add New Product</h1>
            <p class="text-sm text-gray-500">Create a new product for your store catalog.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-primary transition-all text-sm font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Back to Products
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <div class="lg:col-span-3">
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-700">
                <strong class="font-semibold">Please fix the following errors:</strong>
                <ul class="mt-2 space-y-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-700">
                {{ session('error') }}
            </div>
            @endif
        </div>
        <!-- Left: Basic Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4">General Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                        <input type="text" name="name" id="product_name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="e.g. Nike Air Max 270">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Slug</label>
                        <input type="text" name="slug" id="product_slug" value="{{ old('slug') }}" readonly class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 cursor-not-allowed" placeholder="auto-generated-slug">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="e.g. NIKE-AM270-001">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Brand</label>
                        <select name="brand" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                            <option value="">Select Brand</option>
                            @foreach(\App\Models\Brand::all() as $brand)
                            <option value="{{ $brand->name }}" {{ old('brand') == $brand->name ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Short Description</label>
                    <textarea name="short_description" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Brief summary of the product...">{{ old('short_description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Description</label>
                    <textarea name="full_description" id="editor" class="hidden">{{ old('full_description') }}</textarea>
                </div>
            </div>

            <!-- Inventory & Pricing -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4">Inventory & Pricing</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Regular Price (₹)</label>
                        <input type="number" name="price" value="{{ old('price') }}" required step="0.01" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Discount Price (₹)</label>
                        <input type="number" name="discount_price" value="{{ old('discount_price') }}" step="0.01" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="0">
                    </div>
                </div>
            </div>

            <!-- Media Upload -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4">Product Gallery</h3>
                <div class="drop-zone p-10 rounded-2xl flex flex-col items-center justify-center space-y-4 cursor-pointer hover:bg-gray-50" id="drop_zone">
                    <div class="w-16 h-16 bg-primary/5 text-primary rounded-full flex items-center justify-center">
                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-bold text-gray-900">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">PNG, JPG, JPEG up to 2MB (Multiple allowed)</p>
                    </div>
                    <input type="file" name="gallery_images[]" id="gallery_input" multiple class="hidden" accept="image/*">
                </div>
                <div id="gallery_preview" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <!-- Previews will appear here -->
                </div>
            </div>
        </div>

        <!-- Right: Status & Main Image -->
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4">Product Status</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-semibold text-gray-700">Publish Status</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" value="1" {{ old('status', '1') ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:width-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="text-sm font-semibold text-gray-700">Featured Product</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:width-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-4">Main Image</h3>
                <div class="space-y-4">
                    <div class="w-full aspect-square bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden relative group" id="main_image_container">
                        <img id="main_image_preview" src="" class="hidden w-full h-full object-cover">
                        <div class="text-center group-hover:text-primary transition-all" id="main_image_placeholder">
                            <i class="fas fa-image text-3xl mb-2 text-gray-300"></i>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Upload Main Image</p>
                        </div>
                    </div>
                    <input type="file" name="main_image" id="main_image_input" required class="hidden" accept="image/*">
                    <button type="button" onclick="document.getElementById('main_image_input').click()" class="w-full border border-gray-200 text-gray-600 text-xs font-bold py-3 rounded-xl hover:bg-gray-50 transition-all uppercase tracking-wider">
                        Select Image
                    </button>
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-primary text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98]">
                    Save Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 flex items-center justify-center bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-all">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    // CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => { console.error(error); });

    // Slug Auto-generation
    document.getElementById('product_name').addEventListener('input', function() {
        let slug = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('product_slug').value = slug;
    });

    // Main Image Preview
    document.getElementById('main_image_input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('main_image_preview').src = e.target.result;
                document.getElementById('main_image_preview').classList.remove('hidden');
                document.getElementById('main_image_placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Gallery Preview & Drag/Drop
    const dropZone = document.getElementById('drop_zone');
    const galleryInput = document.getElementById('gallery_input');
    const galleryPreview = document.getElementById('gallery_preview');

    dropZone.addEventListener('click', () => galleryInput.click());

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drop-zone--over');
    });

    ['dragleave', 'dragend'].forEach(type => {
        dropZone.addEventListener(type, () => {
            dropZone.classList.remove('drop-zone--over');
        });
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        if (e.dataTransfer.files.length) {
            galleryInput.files = e.dataTransfer.files;
            handleGalleryPreview(e.dataTransfer.files);
        }
        dropZone.classList.remove('drop-zone--over');
    });

    galleryInput.addEventListener('change', (e) => {
        handleGalleryPreview(e.target.files);
    });

    function handleGalleryPreview(files) {
        galleryPreview.innerHTML = '';
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'aspect-square rounded-xl overflow-hidden border border-gray-100 relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                        <i class="fas fa-times text-gray-400 cursor-pointer"></i>
                    </div>
                `;
                galleryPreview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
