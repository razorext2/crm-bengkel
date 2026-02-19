<?php

namespace App\Livewire\Dashboard\Delivery;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Delivery;
use Livewire\Component;

class View extends Component
{
    use HandlesErrors;

    public Delivery $form;

    public $id;

    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = \App\Models\Transaction::with('transactionDetail', 'user')->findOrFail($id);
        $this->form->shipping_service = $this->data->shipping_service;
        $this->form->shipping_cost = $this->data->shipping_cost;
        $this->form->resi_number = $this->data->resi_number;
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

    public function store()
    {
        $this->form->validate();

        $this->runSafely(function () {
            // update pengiriman
            $this->data->update([
                'shipping_service' => $this->form->shipping_service,
                'shipping_cost' => $this->form->shipping_cost,
                'resi_number' => $this->form->resi_number,
                'order_status' => 2, // pesanan dikirim
                'is_delivered' => 1,
                'delivered_at' => now(),
            ]);

            // swal
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data pengiriman berhasil diperbarui.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal memperbarui data pengiriman.', [
            'user_id' => auth()->id(),
            'action' => 'update_delivery',
            'transaction_id' => $this->data->id,
        ]);
    }

    public function markAsCompleted($id)
    {
        if ($this->data->id !== $id) {
            return $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Transaksi tidak ditemukan.',
            ]);
        }

        $this->runSafely(function () {
            // update
            $this->data->update([
                'is_completed' => 1,
                'completed_at' => now(),
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil menyelesaikan pesanan.',
            ]);
        }, 'Gagal menandai pesanan selesai.', [
            'user_id' => auth()->id(),
            'action' => 'mark_as_completed',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.delivery.view');
    }
}
