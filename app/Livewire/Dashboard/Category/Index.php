<?php

namespace App\Livewire\Dashboard\Category;

use App\Livewire\Concerns\HandlesErrors;
use App\Models\ProductCategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use HandlesErrors, WithPagination;

    public $sortBy = 'created_at';

    public $sortDirection = 'desc';

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[Computed]
    public function categories()
    {
        return ProductCategory::query()
            ->withCount('products')
            ->tap(function ($query) {
                $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query;
            })
            ->paginate(10);
    }

    public function delete($id)
    {
        $this->runSafely(function () use ($id) {
            ProductCategory::findOrFail($id)->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil menghapus data kategori.',
            ]);

            $this->dispatch('$refresh');

        }, 'Gagal menghapus data kategori.', [
            'user_id' => auth()->id(),
            'action' => 'delete_kategori',
        ]);
    }

    public function render()
    {

        return view('livewire.dashboard.category.index');
    }
}
