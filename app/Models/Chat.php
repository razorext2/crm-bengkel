<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'product_id',
        'transaction_id',
        'has_read',
        'read_at',
    ];

    protected $casts = [
        'has_read' => 'boolean',
    ];

    public function fromUserId()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function toUserId()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
}
