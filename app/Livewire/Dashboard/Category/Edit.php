<?php

namespace App\Livewire\Dashboard\Category;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Category;
use App\Models\ProductCategory;
use Livewire\Component;

class Edit extends Component
{
    use HandlesErrors;

    public ProductCategory $category;

    public Category $catForm;

    public function mount($id)
    {
        $this->category = ProductCategory::findOrFail($id);
        $this->catForm->name = $this->category->category_name;
        $this->catForm->description = $this->category->category_description;
    }

    public function store()
    {
        $this->catForm->validate();

        $this->runSafely(function () {
            $this->category->update([
                'category_name' => $this->catForm->name,
                'category_description' => $this->catForm->description,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil mengubah data kategori.',
            ]);

            $this->redirectRoute('category.index');
        }, 'Gagal mengubah data kategori', [
            'user_id' => auth()->id(),
            'action' => 'update_kategori',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.category.edit');
    }
}
