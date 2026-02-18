<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = [
        'category_name',
        'category_icon',
        'category_image',
        'category_description',
    ];

    protected $casts = [
        'category_image' => 'array',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
