<?php

namespace App\Livewire\Utils;

use App\Models\CustomerCartItem;
use Livewire\Component;

class CartNavbar extends Component
{
    public $cartItems = null;

    public function mount()
    {
        $this->cartItems = CustomerCartItem::where('user_id', auth()->user()->id)->get();
    }

    public function removeItem($id)
    {
        CustomerCartItem::where('user_id', auth()->user()->id)
            ->where('product_id', $id)
            ->delete();

        $this->dispatch('$refresh');

        dd('Berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.utils.cart-navbar');
    }
}
