<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'category_id' => $category->id,
                'name' => "Sample Product $i",
                'slug' => "sample-product-$i",
                'short_description' => "This is a short description for product $i",
                'full_description' => "This is a full description for product $i",
                'price' => rand(1000, 5000),
                'sku' => "SKU-00$i",
                'stock_quantity' => rand(5, 50),
                'main_image' => "$i.jpg",
                'status' => true,
                'is_featured' => $i % 3 == 0,
            ]);
        }
    }
}
