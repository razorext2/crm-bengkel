<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = 'customer_addresses';

    protected $fillable = [
        'user_id',
        'address_name',
        'city',
        'province',
        'country',
        'postal_code',
        'address_detail',
        'receiver_name',
        'receiver_phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',
            'id');
    }
}
