<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Anime', 'Car', 'DC', 'F1 Racing', 'Football', 'Game', 'Gym', 'Marvel'];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'status' => true,
            ]);
        }
    }
}
