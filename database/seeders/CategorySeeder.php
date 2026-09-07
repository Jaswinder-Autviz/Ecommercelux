<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Abstract', 'Minimalist', 'Nature', 'Typography', 'Cars', 'Anime', 'Motivational', 'Luxury', 'Black & White', 'Modern Art'];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'status' => true,
            ]);
        }
    }
}
