<?php

namespace App\Livewire\Pages\Account;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Address;
use App\Models\CustomerAddress;
use App\Models\CustomerProfile;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Addresses extends Component
{
    use HandlesErrors;

    public Address $form;

    public ?bool $showAddModal = false;

    public function mount()
    {
        $this->form->country = 'Indonesia';
    }

    public function addAddressProcess()
    {
        $this->form->validate();

        $this->runSafely(function () {
            CustomerAddress::create([
                'user_id' => auth()->user()->id,
                'address_name' => $this->form->address_name,
                'city' => $this->form->city,
                'province' => $this->form->province,
                'country' => $this->form->country,
                'postal_code' => $this->form->postal_code,
                'receiver_name' => $this->form->receiver_name,
                'receiver_phone' => $this->form->receiver_phone,
                'address_detail' => $this->form->description,
            ]);

            $this->form->reset();
            $this->showAddModal = false;

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Alamat berhasil ditambahkan.',
            ]);
        }, 'Gagal menambah alamat baru.', [
            'user_id' => auth()->user()->id,
            'action' => 'Tambah Alamat',
        ]);
    }

    public function deleteAddress($id)
    {
        // CEK APAKAH ALAMAT UTAMA
        if (auth()->user()->profile?->primaryAddress->id === $id) {
            return $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Alamat utama tidak bisa dihapus. Silakan ganti alamat utama terlebih dahulu.',
            ]);
        }

        $this->runSafely(function () use ($id) {
            $address = CustomerAddress::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->firstOrFail();

            $address->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Alamat berhasil dihapus.',
            ]);
        }, 'Gagal menghapus alamat.', [
            'user_id' => auth()->user()->id,
            'action' => 'Hapus Alamat',
        ]);
    }

    public function makePrimary($id)
    {
        $this->runSafely(function () use ($id) {
            $profile = CustomerProfile::where('user_id', auth()->user()->id)->firstOrFail();

            $profile->primary_address_id = $id;
            $profile->save();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Alamat berhasil dijadikan utama.',
            ]);
        }, 'Gagal menjadikan alamat utama.', [
            'user_id' => auth()->user()->id,
            'action' => 'Jadikan Alamat Utama',
        ]);
    }

    #[Layout('layouts.app-customer')]
    public function render()
    {
        $addresses = CustomerAddress::with('user')
            ->where('user_id', auth()->user()->id)
            ->get();

        $provinces = \Laravolt\Indonesia\Facade::allProvinces()->toArray();
        $province = [];

        if ($this->form->province) {
            $province = \Laravolt\Indonesia\Facade::findProvince(provinceId: $this->form->province, with: 'cities')->toArray();
        }

        return view('livewire.pages.account.addresses', [
            'addresses' => $addresses,
            'provinces' => $provinces,
            'province' => $province,
        ]);
    }
}
