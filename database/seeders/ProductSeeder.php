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
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $posters = [
            [
                'name' => 'Cyber Samurai Neon Noir',
                'sku' => 'POSTER-001',
                'price' => 199,
                'discount_price' => 149,
                'short_description' => 'A futuristic cyberpunk warrior set against glowing neon rain.',
                'image' => '1788762431.jpg',
                'category' => 'Anime',
            ],
            [
                'name' => 'Minimalist Architecture Lines',
                'sku' => 'POSTER-002',
                'price' => 249,
                'discount_price' => 179,
                'short_description' => 'Monochrome architectural abstraction celebrating modern form and shadow.',
                'image' => '1788762535.png',
                'category' => 'Minimalist',
            ],
            [
                'name' => 'Cosmic Drift Supercar',
                'sku' => 'POSTER-003',
                'price' => 299,
                'discount_price' => 199,
                'short_description' => 'High speed aerodynamic luxury sports car drifting through vaporwave haze.',
                'image' => '1788763002.jpg',
                'category' => 'Cars',
            ],
            [
                'name' => 'Ethereal Geometry Abstract',
                'sku' => 'POSTER-004',
                'price' => 199,
                'discount_price' => 149,
                'short_description' => 'Subtle interlocking gold and obsidian geometry on matte background.',
                'image' => '1788762431.jpg',
                'category' => 'Abstract',
            ],
            [
                'name' => 'Tokyo Rain Neo Tokyo',
                'sku' => 'POSTER-005',
                'price' => 249,
                'discount_price' => 179,
                'short_description' => 'Cinematic nighttime street of Shinjuku reflecting glowing lantern hues.',
                'image' => '1788762535.png',
                'category' => 'Anime',
            ],
            [
                'name' => 'Zen Botanical Harmony',
                'sku' => 'POSTER-006',
                'price' => 199,
                'discount_price' => 149,
                'short_description' => 'Organic botanical study featuring soothing neutral tones.',
                'image' => '1788763002.jpg',
                'category' => 'Nature',
            ],
            [
                'name' => 'Relentless Hustle Typography',
                'sku' => 'POSTER-007',
                'price' => 249,
                'discount_price' => 179,
                'short_description' => 'Bold typographic manifesto designed to inspire peak daily execution.',
                'image' => '1788762431.jpg',
                'category' => 'Motivational',
            ],
            [
                'name' => 'Dark Horizon Mountain Range',
                'sku' => 'POSTER-008',
                'price' => 299,
                'discount_price' => 199,
                'short_description' => 'Dramatic mountain ridges bathed in mist and cool twilight gradients.',
                'image' => '1788762535.png',
                'category' => 'Black & White',
            ],
            [
                'name' => 'Vintage GT Apex Legend',
                'sku' => 'POSTER-009',
                'price' => 299,
                'discount_price' => 199,
                'short_description' => 'Classic motorsport heritage captured with timeless vintage grain.',
                'image' => '1788763002.jpg',
                'category' => 'Cars',
            ],
            [
                'name' => 'Astral Mind Nebula Glow',
                'sku' => 'POSTER-010',
                'price' => 249,
                'discount_price' => 179,
                'short_description' => 'Deep interstellar nebula clouds radiating vivid chromatic light.',
                'image' => '1788762431.jpg',
                'category' => 'Modern Art',
            ],
            [
                'name' => 'Monochrome Bauhaus Sphere',
                'sku' => 'POSTER-011',
                'price' => 199,
                'discount_price' => 149,
                'short_description' => 'Classic Bauhaus geometric balance and typography in stark black and white.',
                'image' => '1788762535.png',
                'category' => 'Minimalist',
            ],
            [
                'name' => 'Golden Ratio Spiral Luxe',
                'sku' => 'POSTER-012',
                'price' => 299,
                'discount_price' => 199,
                'short_description' => 'The divine mathematical proportion visualized in metallic gold tones.',
                'image' => '1788763002.jpg',
                'category' => 'Luxury',
            ],
        ];

        foreach ($posters as $item) {
            $cat = $categories->firstWhere('name', $item['category']) ?? $categories->first();
            Product::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'category_id' => $cat?->id,
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),
                    'short_description' => $item['short_description'],
                    'full_description' => '<p>' . $item['short_description'] . ' Premium museum-grade archival matte print sized strictly at 12 × 8 inches.</p>',
                    'price' => $item['price'],
                    'discount_price' => $item['discount_price'],
                    'stock_quantity' => 150,
                    'sizes' => [Product::POSTER_SIZE],
                    'main_image' => $item['image'],
                    'status' => true,
                    'is_featured' => true,
                ]
            );
        }
    }
}
