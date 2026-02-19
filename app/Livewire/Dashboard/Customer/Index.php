<?php

namespace App\Livewire\Dashboard\Customer;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

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
    public function customers()
    {
        return User::query()
            ->with('profile')
            ->where('is_admin', 0)
            ->tap(function ($query) {
                $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query;
            })
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.dashboard.customer.index');
    }
}
