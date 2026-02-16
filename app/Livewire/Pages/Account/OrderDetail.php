<?php

namespace App\Livewire\Pages\Account;

use Livewire\Component;

class OrderDetail extends Component
{
    public ?int $id = null;

    public $data = null;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = \App\Models\Transaction::with('transactionDetail')
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.account.order-detail');
    }
}
