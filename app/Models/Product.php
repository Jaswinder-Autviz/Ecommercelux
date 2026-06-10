<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const DEFAULT_APPAREL_SIZES = ['S', 'M', 'L', 'XL', '2XL'];
    public const PLACEHOLDER_IMAGE = 'placeholder-product.svg';

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
        'sizes',
        'main_image',
        'gallery_images',
        'tags',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'sizes' => 'array',
        'gallery_images' => 'array',
        'status' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function getAvailableSizesAttribute(): array
    {
        return is_array($this->sizes) && count($this->sizes) > 0
            ? $this->sizes
            : self::DEFAULT_APPAREL_SIZES;
    }

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
