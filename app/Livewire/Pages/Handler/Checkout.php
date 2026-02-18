<?php

namespace App\Livewire\Pages\Handler;

use App\Livewire\Concerns\HandlesErrors;
use App\Models\CustomerCartItem;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    use HandlesErrors;

    public $cartItems = null;

    public $deliveryAddress = null;

    public ?float $totalPrice = null;

    public function mount()
    {
        $this->cartItems = CustomerCartItem::where('user_id', auth()->user()->id)->get();

        $userAddress = auth()->user()->addresses()->first();

        if ($userAddress) {
            $this->deliveryAddress = $userAddress->address_detail.', '.$userAddress->city.', '.$userAddress->province.', '.$userAddress->country.', '.$userAddress->postal_code;
        }
    }

    public function processToCheckout()
    {
        $this->runSafely(function () {
            $transaction = DB::transaction(function () {
                $totalPrice = 0;

                // tambah transaksi
                $transaction = Transaction::create([
                    'invoice_number' => 'INV-'.time(),
                    'user_id' => auth()->user()->id,
                    'total_amount' => 0, // akan dihitung setelah detail transaksi dibuat
                    'resi_number' => null,
                    'order_status' => 0, // pending / menunggu pembayaran
                    'shipping_cost' => 0,
                    'payment_proof' => null,
                    'description' => null,
                ]);

                // tambah detail transaksi
                foreach ($this->cartItems as $item) {
                    $totalPrice += $item->product->price * $item->quantity;

                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $item->product_id,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'subtotal_price' => $item->product->price * $item->quantity,
                    ]);
                }

                $transaction->update([
                    'total_amount' => $totalPrice,
                ]);

                // hapus cart item setelah checkout
                CustomerCartItem::where('user_id', auth()->user()->id)->delete();

                return $transaction;
            });

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Checkout Berhasil',
                'text' => 'Pesanan Anda telah berhasil diproses. Silahkan update bukti pembayaran terlebih dahulu!',
            ]);

            return redirect()->route('account.order.detail', $transaction->id);
        }, 'Checkout Gagal, terjadi kesalahan saat memproses checkout. Silahkan coba lagi nanti.', [
            'user_id' => auth()->user()->id,
            'action' => 'process_to_checkout',
        ]);
    }

    public function render()
    {
        return view('livewire.pages.handler.checkout');
    }
}
