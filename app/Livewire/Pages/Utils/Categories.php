<?php

namespace App\Livewire\Pages\Utils;

use Livewire\Component;

class Categories extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = \App\Models\ProductCategory::all();
    }

    public function render()
    {
        return view('livewire.pages.utils.categories');
    }
}
