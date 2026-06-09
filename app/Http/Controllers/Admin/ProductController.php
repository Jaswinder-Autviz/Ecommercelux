<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'sku' => 'required|string|unique:products,sku',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = $this->resolveProductSlug($request->name);
        if (! $slug) {
            return redirect()->back()->withInput()->with('error', 'A product with this name already exists. Please choose a different name.');
        }

        $data = $request->except(['main_image', 'gallery_images']);
        $data['slug'] = $slug;
        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');
        
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
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = $this->resolveProductSlug($request->name, $product->id);
        if (! $slug) {
            return redirect()->back()->withInput()->with('error', 'A product with this name already exists. Please choose a different name.');
        }

        $data = $request->except(['main_image', 'gallery_images']);
        $data['slug'] = $slug;
        $data['status'] = $request->has('status');
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($product->main_image && file_exists(public_path('assets/images/products/' . $product->main_image))) {
                unlink(public_path('assets/images/products/' . $product->main_image));
            }
            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('assets/images/products'), $imageName);
            $data['main_image'] = $imageName;
        }

        $product->update($data);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('assets/images/products'), $galleryImageName);
                $product->images()->create(['image_path' => $galleryImageName]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
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
}
