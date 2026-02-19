<?php

namespace App\Livewire\Pages\Account;

use App\Livewire\Concerns\HandlesErrors;
use App\Models\ProductReview;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OrderReview extends Component
{
    use HandlesErrors;

    public $id;

    public $data;

    public array $ratings = [];

    public array $reviews = [];

    public function mount($id)
    {
        $this->id = $id;
        $this->data = \App\Models\Transaction::with('transactionDetail')
            ->findOrFail($id);
    }

    public function store()
    {
        $this->runSafely(function () {
            DB::transaction(function () {
                foreach ($this->ratings as $transactionId => $rating) {
                    ProductReview::create([
                        'user_id' => auth()->id(),
                        'transaction_id' => $this->id,
                        'product_id' => TransactionDetail::find($transactionId)->product_id,
                        'rating' => $rating,
                        'review' => $this->reviews[$transactionId] ?? null,
                    ]);
                }
            });

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Ulasan berhasil disimpan',
            ]);

            $this->redirectRoute('account.order.detail', $this->id);
        }, 'Gagal menyimpan ulasan', [
            'user_id' => auth()->id(),
            'action' => 'create_review',
        ]);
    }

    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.account.order-review');
    }
}
