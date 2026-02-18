<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Category extends Form
{
    public ?string $name = '';

    public ?string $description = '';

    public ?string $icon = '';

    public ?string $image = '';

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:30',
            'description' => 'required|string|min:10|max:100',
            'icon' => 'nullable',
            'image' => 'nullable',
        ];
    }
}
