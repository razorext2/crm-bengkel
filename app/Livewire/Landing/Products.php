<?php

namespace App\Livewire\Landing;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        return view('livewire.landing.products',
            [
                'products' => Product::paginate(16, pageName: 'product-page'),
            ]);
    }
}
