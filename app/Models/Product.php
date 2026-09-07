<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const POSTER_SIZE = '12 × 8 inches';
    public const DEFAULT_POSTER_SIZES = ['12 × 8 inches'];
    public const DEFAULT_POSTER_FRAMES = [];
    public const DEFAULT_POSTER_MATERIALS = ['Premium Matte 300 GSM'];
    public const DEFAULT_POSTER_ORIENTATIONS = ['Portrait'];
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
        'materials',
        'frames',
        'orientations',
        'main_image',
        'gallery_images',
        'tags',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'sizes' => 'array',
        'materials' => 'array',
        'frames' => 'array',
        'orientations' => 'array',
        'gallery_images' => 'array',
        'status' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function getAvailableSizesAttribute(): array
    {
        return [self::POSTER_SIZE];
    }

    public function getAvailableFramesAttribute(): array
    {
        return [];
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
