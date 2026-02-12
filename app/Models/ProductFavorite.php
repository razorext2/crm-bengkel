<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFavorite extends Model
{
    protected $table = 'product_favorite';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        $this->belongsTo(Product::class, 'product_id');
    }
}
