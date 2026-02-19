<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Delivery extends Form
{
    public ?string $shipping_service = '';

    public ?string $resi_number = '';

    public ?int $shipping_cost = null;

    public function rules()
    {
        return [
            'shipping_service' => ['required'],
            'resi_number' => ['required'],
            'shipping_cost' => ['required'],
        ];
    }
}
