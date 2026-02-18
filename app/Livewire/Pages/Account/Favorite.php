<?php

namespace App\Livewire\Pages\Account;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Favorite extends Component
{
    public function mount()
    {
        if (! auth()->check()) {
            return $this->redirect(route('login'));
        }
    }

    public function getProductsProperty()
    {
        return \App\Models\Product::whereHas('favorites', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->with(['category', 'reviews'])
            ->get();
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

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Produk berhasil dihapus dari favorit',
            ]);
        } else {
            \App\Models\ProductFavorite::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Produk berhasil ditambahkan ke favorit',
            ]);
        }

        $this->dispatch('$refresh');
    }

    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.account.favorite');
    }
}
