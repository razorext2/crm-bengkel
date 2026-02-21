<?php

namespace App\Livewire\Dashboard\Voucher;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Voucher as VoucherForm;
use Livewire\Component;

class Create extends Component
{
    use HandlesErrors;

    public VoucherForm $voucherForm;

    public function store()
    {
        $this->voucherForm->validate();

        $this->runSafely(function () {
            \App\Models\Voucher::create([
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

            $this->voucherForm->reset();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data voucher berhasil disimpan.',
            ]);
        }, 'Gagal menyimpan data voucher.', [
            'user_id' => auth()->id(),
            'action' => 'create_voucher',
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.voucher.create');
    }
}
