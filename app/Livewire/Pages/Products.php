<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFavorite;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

class Products extends Component
{
    public $category_id;

    #[Url(as: 'price')]
    public array $priceRanges = [];

    #[Url(as: 'categories')]
    public array $categories = [];

    #[Url(as: 'name')]
    public ?string $search = '';

    public bool $aria_expanded = true;

    public function mount()
    {
        $category = isset($_GET['category']) ? $_GET['category'] : 0;
        $this->category_id = $category;

        if ($category != 0) {
            $this->categories[$category] = true;
        }
    }

    public function getCategories()
    {
        return ProductCategory::all();
    }

    public function getCategoryById()
    {
        return ProductCategory::findOrFail($this->category_id);
    }

    #[Computed]
    public function getProducts()
    {
        $query = Product::with(['category']);

        // filter multiple categories
        $selectedCategories = collect($this->categories)
            ->filter(fn ($checked) => $checked)
            ->keys()
            ->toArray();

        if (! empty($selectedCategories)) {
            $query->whereIn('category_id', $selectedCategories);
        }

        // filter multiple prices
        $selectedRanges = collect($this->priceRanges)
            ->filter(fn ($checked) => $checked)
            ->keys()
            ->toArray();

        if (! empty($selectedRanges)) {
            $query->where(function ($q) use ($selectedRanges) {
                foreach ($selectedRanges as $range) {
                    match ($range) {
                        'under_99' => $q->orWhere('price', '<', 99999),
                        '100_249' => $q->orWhereBetween('price', [100000, 249999]),
                        '250_499' => $q->orWhereBetween('price', [250000, 499999]),
                        '500_999' => $q->orWhereBetween('price', [500000, 999999]),
                        'above_1jt' => $q->orWhere('price', '>=', 1000000),
                    };
                }
            });
        }

        // filter berdasarkan nama
        if (! is_null($this->search || $this->search != '')) {
            $query->where('product_name', 'like', '%'.$this->search.'%');
        }

        return $query->paginate(16, pageName: 'product-page');
    }

    public function updatedCategoryId()
    {
        $this->categories = [];
    }

    public function addToCart($id)
    {
        // check apakah sudah auth
        if (! auth()->check()) {
            return $this->redirect(route('login'));
        }

        // check apakah udah dicart
        $cart = \App\Models\CustomerCartItem::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            \App\Models\CustomerCartItem::create([
                'user_id' => auth()->id(),
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
        $fav = ProductFavorite::where('user_id', auth()->id())->where('product_id', $id)->first();

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
                'user_id' => auth()->id(),
                'product_id' => $id,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Produk berhasil ditambahkan ke favorit',
            ]);
        }
    }

    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.products');
    }
}
