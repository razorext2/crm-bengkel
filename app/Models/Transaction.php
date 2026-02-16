<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'invoice_number',
        'user_id',
        'total_amount',
        'resi_number',
        'order_status',
        'shipping_service',
        'shipping_cost',
        'payment_proof',
        'description',
    ];

    public function casts()
    {
        return [
            'payment_proof' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function getOrderStatusDescriptionAttribute()
    {
        return match ($this->order_status) {
            0 => [
                'value' => 'pending',
                'description' => 'Menunggu Pembayaran',
            ],
            1 => [
                'value' => 'paid',
                'description' => 'Pembayaran Diterima',
            ],
            2 => [
                'value' => 'shipped',
                'description' => 'Pesanan Dikirim',
            ],
            3 => [
                'value' => 'delivered',
                'description' => 'Pesanan Diterima',
            ],
            4 => [
                'value' => 'cancelled',
                'description' => 'Pesanan Dibatalkan',
            ],
            default => [
                'value' => null,
                'description' => 'Status Tidak Diketahui',
            ],
        };
    }
}
