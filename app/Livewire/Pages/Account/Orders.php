<?php

namespace App\Livewire\Pages\Account;

use App\Livewire\Concerns\HandlesErrors;
use Livewire\Component;

class Orders extends Component
{
    use HandlesErrors;

    public function mount() {}

    public function cancelTransaction($id)
    {
        // jalankan cancel
        $this->runSafely(function () use ($id) {
            \App\Models\Transaction::where('id', $id)
                ->where('user_id', auth()->id())
                ->update(['order_status' => 4]);

            // kasih session flash
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Transaksi Dibatalkan',
                'text' => 'Berhasil membatalkan transaksi.',
            ]);
        }, 'Gagal membatalkan transaksi.', [
            'user_id' => auth()->id(),
            'action' => 'Batalkan Transaksi',
        ]);
    }

    public function render()
    {
        $transactions = \App\Models\Transaction::where('user_id', auth()->id())
            ->orderBy('order_status', 'asc')
            ->paginate(perPage: 5, pageName: 'transaction-page');

        return view('livewire.pages.account.orders', [
            'transactions' => $transactions,
        ]);
    }
}
