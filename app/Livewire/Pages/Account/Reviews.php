<?php

namespace App\Livewire\Pages\Account;

use App\Models\ProductReview;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;

    #[Layout('layouts.app-customer')]
    public function render()
    {
        $data = ProductReview::with('user', 'product')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10, pageName: 'review-page');

        return view('livewire.pages.account.reviews', compact('data'));
    }
}
