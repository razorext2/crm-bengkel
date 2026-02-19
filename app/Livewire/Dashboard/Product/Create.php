<?php

namespace App\Livewire\Dashboard\Product;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Attachment;
use App\Livewire\Forms\Product as ProductForm;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use HandlesErrors, WithFileUploads;

    public Attachment $docForm;

    public ProductForm $prodForm;

    public function storeLampiran()
    {
        $this->docForm->validate();

        $this->docForm->addAttachment();
    }

    public function removeAttachment($index)
    {
        $this->docForm->removeAttachment($index);
    }

    public function store()
    {
        $this->prodForm->validate();

        $this->runSafely(function () {
            $images = $this->docForm->storeAttachment('products', 'public');
            $image_primary = $images[0]['url'];

            Product::create([
                'category_id' => $this->prodForm->category,
                'product_name' => $this->prodForm->name,
                'product_description' => $this->prodForm->description,
                'product_image_primary' => $image_primary,
                'product_images' => $images,
                'product_unit' => $this->prodForm->unit,
                'product_weight' => $this->prodForm->weight,
                'price' => $this->prodForm->price,
                'stock' => $this->prodForm->stock,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil.',
                'text' => 'Berhasil menambah produk baru.',
            ]);

            $this->redirectRoute('product.index');
        }, 'Gagal menambah produk.', [
            'user_id' => auth()->id(),
            'action' => 'create_product',
        ]);
    }

    public function render()
    {
        $category = ProductCategory::all();
        $unit = config('crm.satuan');

        return view('livewire.dashboard.product.create', [
            'categories' => $category,
            'units' => $unit,
        ]);
    }
}
