<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Voucher extends Form
{
    public ?string $code = '';

    public ?string $discount_type = '';

    public ?float $discount_value = null;

    public ?float $min_transaction = null;

    public ?int $max_usage = null;

    public ?int $usage_per_user = null;

    public ?string $start_at = '';

    public ?string $end_at = '';

    public ?bool $is_active = false;

    public ?bool $new_user_only = false;

    public ?int $min_user_transactions = null;

    public ?int $max_user_transactions = null;

    public function rules()
    {
        return [
            'code' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'min_transaction' => 'required',
            'max_usage' => 'required',
            'usage_per_user' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'is_active' => 'required',
            'new_user_only' => 'required',
            'min_user_transactions' => 'required',
            'max_user_transactions' => 'required',
        ];
    }
}
