<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const DEFAULT_POSTER_SIZES = ['8×12', '12×18', '18×24', '24×36'];
    public const DEFAULT_POSTER_FRAMES = ['Unframed (Rolled)', 'Black', 'White'];
    public const DEFAULT_POSTER_MATERIALS = ['Paper', 'Premium Matte', 'Canvas'];
    public const DEFAULT_POSTER_ORIENTATIONS = ['Portrait', 'Landscape', 'Square'];
    public const DEFAULT_APPAREL_SIZES = self::DEFAULT_POSTER_SIZES;
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
        return is_array($this->sizes) && count($this->sizes) > 0
            ? $this->sizes
            : self::DEFAULT_POSTER_SIZES;
    }

    public function getAvailableFramesAttribute(): array
    {
        return is_array($this->frames) && count($this->frames) > 0
            ? $this->frames
            : self::DEFAULT_POSTER_FRAMES;
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
