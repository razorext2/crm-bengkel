<?php

namespace App\Livewire\Landing;

use App\Models\Product;
use App\Models\ProductFavorite;
use Livewire\Component;

class Products extends Component
{
    public function addToFavorite($id)
    {
        // check apakah sudah auth
        if (! auth()->check()) {
            return $this->redirect(route('login'));
        }

        // check apakah sudah difavorit
        $fav = ProductFavorite::where('user_id', auth()->user()->id)->where('product_id', $id)->first();

        // kalo sudah difavorit
        if ($fav) {
            // hapus
            $fav->delete($id);
        } else {
            ProductFavorite::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ]);
        }

    }

    public function render()
    {
        return view('livewire.landing.products',
            [
                'products' => Product::paginate(16, pageName: 'product-page'),
            ]);
    }
}
