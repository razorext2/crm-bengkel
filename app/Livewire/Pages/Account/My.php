<?php

namespace App\Livewire\Pages\Account;

use Livewire\Attributes\Layout;
use Livewire\Component;

class My extends Component
{
    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.account.my');
    }
}
