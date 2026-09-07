<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Product::query()->whereNull('sizes')->update([
            'sizes' => json_encode(Product::DEFAULT_POSTER_SIZES),
        ]);
    }

    public function down(): void
    {
        // The sizes column is owned by the products table migration.
    }
};
