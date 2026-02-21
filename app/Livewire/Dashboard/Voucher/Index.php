<?php

namespace App\Livewire\Dashboard\Voucher;

use App\Livewire\Concerns\HandlesErrors;
use App\Models\Voucher;
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
    public function vouchers()
    {
        return Voucher::query()
            ->withCount('usages')
            ->tap(function ($query) {
                $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query;
            })
            ->paginate(10);
    }

    public function delete($id)
    {
        $this->runSafely(function () use ($id) {
            Voucher::findOrFail($id)->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil menghapus data voucher.',
            ]);

            $this->dispatch('$refresh');

        }, 'Gagal menghapus data voucher.', [
            'user_id' => auth()->id(),
            'action' => 'delete_voucher',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.voucher.index');
    }
}
