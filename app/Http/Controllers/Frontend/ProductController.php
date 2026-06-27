<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', true)->with(['category', 'images'])->latest()->paginate(12);
        return view('frontend.shop.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'images'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['category', 'images'])
            ->take(4)
            ->get();

        return view('frontend.product.show', compact('product', 'relatedProducts'));
    }
}
