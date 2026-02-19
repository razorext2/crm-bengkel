<?php

namespace App\Livewire\Dashboard\Product;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Attachment;
use App\Livewire\Forms\Product as FormsProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class Edit extends Component
{
    use HandlesErrors;

    public Product $product;

    public FormsProduct $prodForm;

    public Attachment $docForm;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->prodForm->category = $this->product->category_id;
        $this->prodForm->name = $this->product->product_name;
        $this->prodForm->description = $this->product->product_description;
        $this->prodForm->unit = $this->product->product_unit;
        $this->prodForm->weight = $this->product->product_weight;
        $this->prodForm->price = $this->product->price;
        $this->prodForm->stock = $this->product->stock;

        $this->docForm->new_attachments = $this->product->product_images;
    }

    public function removeAttachment($index)
    {
        $this->docForm->removeAttachment($index);
    }

    public function store()
    {
        $this->prodForm->validate();

        $this->runSafely(function () {
            $this->product->update([
                'category_id' => $this->prodForm->category,
                'product_name' => $this->prodForm->name,
                'product_description' => $this->prodForm->description,
                'product_unit' => $this->prodForm->unit,
                'product_weight' => $this->prodForm->weight,
                'price' => $this->prodForm->price,
                'stock' => $this->prodForm->stock,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil mengubah data produk.',
            ]);

            $this->redirectRoute('product.index');
        }, 'Gagal mengubah data produk', [
            'user_id' => auth()->id(),
            'action' => 'update_produk',
        ]);
    }

    public function render()
    {
        $category = ProductCategory::all();
        $unit = config('crm.satuan');

        return view('livewire.dashboard.product.edit', [
            'categories' => $category,
            'units' => $unit,
        ]);
    }
}
