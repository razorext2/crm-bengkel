<?php

namespace App\Livewire\Pages\Utils;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFavorite;
use Livewire\Attributes\Url;
use Livewire\Component;

class Products extends Component
{
    #[Url(as: 'product_name')]
    public ?string $search = '';

    #[Url(as: 'category')]
    public ?int $category = null;

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

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Berhasil',
            'text' => 'Produk berhasil ditambahkan ke keranjang',
        ]);
    }

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

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Produk berhasil dihapus dari favorit',
            ]);
        } else {
            ProductFavorite::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Produk berhasil ditambahkan ke favorit',
            ]);
        }
    }

    public function render()
    {
        $categories = ProductCategory::get()->toArray();
        $products = Product::query()->with('category')
            ->when($this->search, function ($query) {
                return $query->where('product_name', 'like', '%'.$this->search.'%');
            })
            ->when($this->category, function ($query) {
                return $query->where('category_id', $this->category);
            })
            ->paginate(16, pageName: 'product-page');

        return view('livewire.pages.utils.products',
            [
                'products' => $products,
                'categories' => $categories,
            ]);
    }
}
