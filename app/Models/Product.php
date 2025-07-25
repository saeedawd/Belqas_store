<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Size;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Audience;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'subcategory_id',
        'audience_id',
        'color_id',
        'size_id',
        'name',
        'slug',
        'price',
        'sale_price',
        'discount_price',
        'description',
        'type',
        'stock',
        'image',
        'barcode',
        'views',
        'is_featured',
        'status',
        'is_archived',
        'in_stock',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug) && !empty($product->name)) {
                $product->slug = str()->slug($product->name);
            }
        });
    }

    // 🔗 العلاقات

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function audience()
    {
        return $this->belongsTo(Audience::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_archived', false);
    }

    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

}
