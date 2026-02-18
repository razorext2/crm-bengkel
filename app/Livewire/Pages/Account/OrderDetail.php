<?php

namespace App\Livewire\Pages\Account;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Attachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class OrderDetail extends Component
{
    use HandlesErrors, WithFileUploads;

    public Attachment $docForm;

    public ?int $id = null;

    public $data = null;

    public ?bool $showPaymentProofModal = false;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = \App\Models\Transaction::with('transactionDetail')
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();
    }

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
        $this->runSafely(function () {
            // buat array lampiran untuk disimpan
            $lampiran = $this->docForm->storeAttachment();

            // simpan lampiran
            $this->data->update([
                'payment_proof' => $lampiran,
            ]);

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil.',
                'text' => 'Bukti pembayaran berhasil diunggah.',
            ]);

        }, 'Gagal menyimpan bukti pembayaran.', [
            'user_id' => auth()->id(),
            'transaction_id' => $this->id,
            'action' => 'upload_bukti_pembayaran',
        ]);
    }

    public function render()
    {
        return view('livewire.pages.account.order-detail');
    }
}
