<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

class BestSeller extends Component
{
    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.best-seller');
    }
}
