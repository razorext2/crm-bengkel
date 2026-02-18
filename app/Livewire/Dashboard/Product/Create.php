<?php

namespace App\Livewire\Dashboard\Product;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Attachment;
use App\Livewire\Forms\Category as CategoryForm;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use HandlesErrors, WithFileUploads;

    public Attachment $docForm;

    public CategoryForm $catForm;

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
        $this->catForm->validate();

        $this->runSafely(function () {
            $icon = $this->docForm->storeAttachment('categories/icons', 'public')[0]['url'];

            Product::create([
                'category_name' => $this->catForm->name,
                'category_icon' => $icon,
                'category_description' => $this->catForm->description,
                'category_image' => null,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil.',
                'text' => 'Berhasil menambah kategori baru.',
            ]);

            $this->redirectRoute('category.index');
        }, 'Gagal menambah kategori.', [
            'user_id' => auth()->id(),
            'action' => 'create_category',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.product.create');
    }
}
