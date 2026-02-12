<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'product_name',
        'product_image_primary',
        'product_images',
        'product_description',
        'product_unit',
        'product_weight',
        'price',
        'stock',
    ];

    protected $casts = [
        'product_images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(ProductFavorite::class, 'product_id', 'id');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'product_favorite');
    }
}
