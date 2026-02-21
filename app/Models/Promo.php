<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promos';

    protected $fillable = [
        'voucher_id',
        'title',
        'description',
        'cover_image',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function voucher()
    {
        return $this->belonsTo(Voucher::class, 'voucher_id', 'id');
    }
}
