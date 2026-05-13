<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/categories'), $filename);
            $imagePath = $filename;
        }

        Category::create([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'image'  => $imagePath,
            'status' => true,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($imagePath && file_exists(public_path('assets/images/categories/' . $imagePath))) {
                unlink(public_path('assets/images/categories/' . $imagePath));
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/categories'), $filename);
            $imagePath = $filename;
        }

        $category->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Block delete if products exist
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete "' . $category->name . '" — it has ' . $category->products()->count() . ' product(s). Please reassign or delete those products first.');
        }

        // Delete image file
        if ($category->image && file_exists(public_path('assets/images/categories/' . $category->image))) {
            unlink(public_path('assets/images/categories/' . $category->image));
        }

        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
