<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TodayPromos extends Component
{
    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.today-promos');
    }
}
