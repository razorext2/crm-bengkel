<?php

namespace App\Livewire\Pages\Product;

use App\Models\Product;
use Livewire\Component;

class Detail extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = Product::find($id);
    }

    public function addToFavorite($id)
    {
        // check apakah sudah auth
        if (! auth()->check()) {
            return $this->redirect(route('login'));
        }

        // check apakah sudah difavorit
        $fav = \App\Models\ProductFavorite::where('user_id', auth()->user()->id)
            ->where('product_id', $id)
            ->first();

        // kalo sudah difavorit
        if ($fav) {
            // hapus
            $fav->delete($id);
        } else {
            \App\Models\ProductFavorite::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ]);
        }
    }

    public function addToCart($id)
    {
        // check apakah sudah auth
        if (! auth()->check()) {
            return $this->redirect(route('login'));
        }

        // check apakah udah dicart
        $cart = \App\Models\CustomerCartItem::where('user_id', auth()->user()->id)
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            \App\Models\CustomerCartItem::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        session()->flash('alert', [
            'type' => 'green',
            'title' => 'Berhasil',
            'message' => 'Produk berhasil ditambahkan ke keranjang',
        ]);
    }

    public function render()
    {
        return view('livewire.pages.product.detail');
    }
}
