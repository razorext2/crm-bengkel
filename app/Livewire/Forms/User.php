<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class User extends Form
{
    public ?string $name = null;

    public ?string $phone = null;

    public ?string $profilePhoto = null;

    public ?string $new_password = null;

    public ?string $new_password_confirmation = null;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'profilePhoto' => ['nullable', 'string', 'max:255'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
