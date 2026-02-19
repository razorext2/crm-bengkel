<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Product extends Form
{
    public ?int $category = null;

    public ?string $name = '';

    public ?string $description = '';

    public ?string $unit = '';

    public ?int $weight = null;

    public ?int $price = null;

    public ?int $stock = null;

    public function rules()
    {
        return [
            'category' => 'required|exists:product_categories,id',
            'name' => 'required|string|min:5|max:100',
            'description' => 'required|string|min:10|max:255',
            'unit' => 'required|string|min:2|max:20',
            'weight' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1',
        ];
    }
}
