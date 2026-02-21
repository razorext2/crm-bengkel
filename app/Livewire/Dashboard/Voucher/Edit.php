<?php

namespace App\Livewire\Dashboard\Voucher;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Voucher as VoucherForm;
use Livewire\Component;

class Edit extends Component
{
    use HandlesErrors;

    public VoucherForm $voucherForm;

    public $id;

    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = \App\Models\Voucher::findOrFail($id);
        $this->voucherForm->fill($this->data);
        $this->voucherForm->start_at = $this->data->start_at;
        $this->voucherForm->end_at = $this->data->end_at;
    }

    public function store()
    {
        $this->voucherForm->validate();

        $this->runSafely(function () {
            $this->data->update([
                'code' => $this->voucherForm->code,
                'discount_type' => $this->voucherForm->discount_type,
                'discount_value' => $this->voucherForm->discount_value,
                'min_transaction' => $this->voucherForm->min_transaction,
                'max_usage' => $this->voucherForm->max_usage,
                'usage_per_user' => $this->voucherForm->usage_per_user,
                'start_at' => $this->voucherForm->start_at,
                'end_at' => $this->voucherForm->end_at,
                'is_active' => $this->voucherForm->is_active,
                'new_user_only' => $this->voucherForm->new_user_only,
                'min_user_transactions' => $this->voucherForm->min_user_transactions,
                'max_user_transactions' => $this->voucherForm->max_user_transactions,
            ]);

            $this->dispatch('$refresh');

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data voucher berhasil diubah.',
            ]);
        }, 'Gagal mengubah data voucher.', [
            'user_id' => auth()->id(),
            'action' => 'create_voucher',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.voucher.edit');
    }
}
