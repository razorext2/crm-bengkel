<?php

namespace App\Livewire\Dashboard\Customer;

use App\Models\User;
use Livewire\Component;

class View extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $user = User::with('profile', 'transactions', 'review', 'favorites')
            ->findOrFail($this->id);

        return view('livewire.dashboard.customer.view', [
            'user' => $user,
        ]);
    }
}
