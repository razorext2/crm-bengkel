<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Address extends Form
{
    public ?string $address_name = '';

    public ?string $city = '';

    public ?string $province = '';

    public ?string $country = '';

    public ?string $postal_code = '';

    public ?string $receiver_name = '';

    public ?string $receiver_phone = '';

    public ?string $description = '';

    public function rules()
    {
        return [
            'address_name' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            'description' => 'required',
        ];
    }
}
