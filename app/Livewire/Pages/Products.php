<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use App\Models\ProductCategory;
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

        // // === FILTER KATEGORI DARI URL ===
        // if ($this->category_id != 0) {
        //     $query->where('category_id', $this->category_id);
        // } else {
        // === FILTER MULTI KATEGORI (CHECKBOX) ===
        $selectedCategories = collect($this->categories)
            ->filter(fn ($checked) => $checked)
            ->keys()
            ->toArray();

        if (! empty($selectedCategories)) {
            $query->whereIn('category_id', $selectedCategories);
        }
        // }

        // === FILTER RENTANG HARGA (CHECKBOX) ===
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

        return $query->paginate(16, pageName: 'product-page');
    }

    public function updatedCategoryId()
    {
        $this->categories = [];
    }

    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.products');
    }
}
