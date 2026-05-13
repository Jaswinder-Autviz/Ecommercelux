<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'full_description',
        'price',
        'discount_price',
        'sku',
        'stock_quantity',
        'brand',
        'main_image',
        'gallery_images',
        'tags',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'status' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
