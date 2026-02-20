<?php

namespace App\Livewire\Pages\Handler;

use App\Livewire\Concerns\HandlesErrors;
use App\Models\CustomerCartItem;
use App\Models\PointHistory;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Checkout extends Component
{
    use HandlesErrors;

    public $cartItems = null;

    public $deliveryAddress = null;

    public ?float $totalPrice = null;

    public ?bool $usePoints = false;

    public ?float $pointsUsed = null;

    public function mount()
    {
        $this->cartItems = CustomerCartItem::where('user_id', auth()->user()->id)->get();

        $userAddress = auth()->user()->addresses()->first();

        if ($userAddress) {
            $this->deliveryAddress = $userAddress->address_detail.', '.$userAddress->city.', '.$userAddress->province.', '.$userAddress->country.', '.$userAddress->postal_code;
        }
    }

    public function qtyPlus($id)
    {
        $data = CustomerCartItem::find($id);

        if ($data->product->stock < $data->quantity + 1) {
            return $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => 'Gagal',
                'text' => 'Stok barang tidak mencukupi',
            ]);
        }

        $data->update([
            'quantity' => $data->quantity + 1,
        ]);
    }

    public function qtyMinus($id)
    {
        $data = CustomerCartItem::find($id);

        if ($data->quantity == 1) {
            return $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => 'Gagal',
                'text' => 'Jumlah barang tidak boleh kurang dari 1',
            ]);
        }

        $data->update([
            'quantity' => $data->quantity - 1,
        ]);
    }

    public function updatedUsePoints()
    {
        if ($this->usePoints === true) {
            $this->pointsUsed = auth()->user()->profile->points;
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

                if ($this->usePoints === true) {
                    // hitung ulang harga
                    $totalPrice = $totalPrice - $this->pointsUsed;

                    // tambah history point
                    PointHistory::create([
                        'transaction_id' => $transaction->id,
                        'user_id' => auth()->id(),
                        'point_used' => $this->pointsUsed,
                    ]);

                    // kurangi point
                    auth()->user()->profile->update([
                        'points' => auth()->user()->profile->points - $this->pointsUsed,
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

    #[Layout('layouts.app-customer')]
    public function render()
    {
        return view('livewire.pages.handler.checkout');
    }
}
