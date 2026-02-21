<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'min_transaction',
        'max_usage',
        'usage_per_user',
        'start_at',
        'end_at',
        'is_active',
        'new_user_only',
        'min_user_transactions',
        'max_user_transactions',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
        'new_user_only' => 'boolean',
    ];

    public function usages()
    {
        return $this->hasMany(VoucherUsage::class, 'voucher_id', 'id');
    }
}
