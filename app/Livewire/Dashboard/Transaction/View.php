<?php

namespace App\Livewire\Dashboard\Transaction;

use App\Livewire\Concerns\HandlesErrors;
use Livewire\Component;

class View extends Component
{
    use HandlesErrors;

    public $id;

    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = \App\Models\Transaction::with('transactionDetail', 'user')
            ->where('id', $this->id)
            ->firstOrFail();
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

    public function confirmPayment($id)
    {
        if ($this->data->id !== $id) {
            return $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Transaksi tidak ditemukan.',
            ]);
        }

        $this->runSafely(function () {
            // tolak transaksi
            $this->data->update([
                'order_status' => 1, // status tolak
            ]);

            // swal
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Transaksi berhasil dikonfirmasi.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal konfirmasi transaksi.', [
            'user_id' => auth()->id(),
            'action' => 'confirm_transaction',
        ]);

    }

    public function declinePayment($id)
    {
        if ($this->data->id !== $id) {
            return $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Transaksi tidak ditemukan.',
            ]);
        }

        $this->runSafely(function () {
            // tolak transaksi
            $this->data->update([
                'order_status' => 4, // status tolak
            ]);

            // swal
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Transaksi berhasil ditolak.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal menolak transaksi.', [
            'user_id' => auth()->id(),
            'action' => 'decline_transaction',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.transaction.view', [
            'data' => $this->data,
        ]);
    }
}
