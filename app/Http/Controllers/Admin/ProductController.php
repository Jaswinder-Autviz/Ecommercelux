<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|max:20',
            'sku' => 'required|string|unique:products,sku',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = $this->resolveProductSlug($request->name);
        if (! $slug) {
            return redirect()->back()->withInput()->with('error', 'A product with this name already exists. Please choose a different name.');
        }

        $data = $request->except(['main_image', 'gallery_images']);
        $data['category_id'] = $request->filled('category_id') ? $request->input('category_id') : null;
        $data['slug'] = $slug;
        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');
        $data['sizes'] = $this->normalizeProductSizes($request->input('sizes', []));
        
        if ($request->hasFile('main_image')) {
            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('assets/images/products'), $imageName);
            $data['main_image'] = $imageName;
        }

        $product = Product::create($data);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('assets/images/products'), $galleryImageName);
                $product->images()->create(['image_path' => $galleryImageName]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|max:20',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = $this->resolveProductSlug($request->name, $product->id);
        if (! $slug) {
            return redirect()->back()->withInput()->with('error', 'A product with this name already exists. Please choose a different name.');
        }

        $data = $request->except(['main_image', 'gallery_images']);
        $data['category_id'] = $request->filled('category_id') ? $request->input('category_id') : null;
        $data['slug'] = $slug;
        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');
        $data['sizes'] = $this->normalizeProductSizes($request->input('sizes', []));

        $oldMainImage = $product->main_image;

        if ($request->hasFile('main_image')) {
            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('assets/images/products'), $imageName);
            $data['main_image'] = $imageName;
        }

        $product->update($data);

        if ($request->hasFile('main_image')) {
            $this->deleteProductImageFileIfUnused($oldMainImage);
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('assets/images/products'), $galleryImageName);
                $product->images()->create(['image_path' => $galleryImageName]);
            }
        }

        return redirect()->route('admin.products.edit', $product->id)->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function destroyGalleryImage(ProductImage $productImage)
    {
        $imagePath = $productImage->image_path;

        $productImage->delete();
        $this->deleteProductImageFileIfUnused($imagePath);

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Gallery image removed successfully.']);
        }

        return back()->with('success', 'Gallery image deleted successfully.');
    }

    public function destroyMainImage(Product $product)
    {
        $imagePath = $product->main_image;

        $product->update(['main_image' => Product::PLACEHOLDER_IMAGE]);
        $this->deleteProductImageFileIfUnused($imagePath);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Main image removed successfully.',
                'placeholder' => asset('assets/images/products/' . Product::PLACEHOLDER_IMAGE),
            ]);
        }

        return back()->with('success', 'Main image removed successfully.');
    }

    private function resolveProductSlug(string $name, ?int $ignoreId = null)
    {
        $slug = Str::slug($name);

        $query = Product::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists() ? null : $slug;
    }

    private function normalizeProductSizes(array $sizes): array
    {
        return [Product::POSTER_SIZE];
    }

    private function deleteProductImageFileIfUnused(?string $imagePath): void
    {
        if (! $imagePath || $imagePath === Product::PLACEHOLDER_IMAGE) {
            return;
        }

        $stillUsedAsMainImage = Product::where('main_image', $imagePath)->exists();
        $stillUsedAsGalleryImage = ProductImage::where('image_path', $imagePath)->exists();

        if ($stillUsedAsMainImage || $stillUsedAsGalleryImage) {
            return;
        }

        $fullPath = public_path('assets/images/products/' . $imagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
