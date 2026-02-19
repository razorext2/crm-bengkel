<?php

namespace App\Livewire\Dashboard\Delivery;

use App\Models\Transaction;
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
    public function transactions()
    {
        return Transaction::query()
            ->with('user', 'transactionDetail')
            ->whereIn('order_status', [1, 2, 3])
            ->tap(function ($query) {
                $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query;
            })
            ->paginate(10);
    }

    public function setStatus($status)
    {
        return match ($status) {
            0 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            1 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            2 => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            3 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            4 => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        };
    }

    public function render()
    {
        return view('livewire.dashboard.delivery.index');
    }
}
