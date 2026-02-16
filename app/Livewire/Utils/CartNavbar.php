<?php

namespace App\Livewire\Utils;

use App\Livewire\Concerns\HandlesErrors;
use App\Models\CustomerCartItem;
use Livewire\Component;

class CartNavbar extends Component
{
    use HandlesErrors;

    public $showCart = false;

    public $cartItems = null;

    public function mount() {}

    public function removeItem($id)
    {
        $this->runSafely(function () use ($id) {
            CustomerCartItem::findOrFail($id)
                ->delete();

            session()->flash('alert', [
                'type' => 'green',
                'title' => 'Berhasil!',
                'message' => 'Produk berhasil dihapus dari keranjang.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal menghapus produk dari keranjang', [
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'action' => 'remove_item_from_cart',
        ]);
    }

    public function render()
    {
        $this->cartItems = CustomerCartItem::where('user_id', auth()->user()->id)->get();

        return view('livewire.utils.cart-navbar', [
            'carts' => $this->cartItems,
        ]);
    }
}
