<?php

namespace App\Livewire\Pages\Account;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\User as FormsUser;
use App\Models\CustomerProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setting extends Component
{
    use HandlesErrors, WithFileUploads;

    public FormsUser $form;

    public $user;

    public ?bool $showEditProfileModal = false;

    public function mount(User $user)
    {
        $this->user = $user->with('addresses', 'profile')->findOrFail(auth()->id());
        $this->form->name = $this->user->name;
        $this->form->phone = $this->user->profile->phone_number ?? null;
        $this->form->profilePhoto = $this->user->profile->profile_photo ?? null;
    }

    public function store()
    {
        $this->validate();

        $this->runSafely(function () {
            DB::transaction(function () {

                $data = [
                    'name' => $this->form->name,
                ];

                // Jika user isi password baru
                if (! empty($this->form->new_password)) {
                    $data['password'] = Hash::make($this->form->new_password);
                }

                $this->user->update($data);

                CustomerProfile::updateOrCreate(
                    ['user_id' => $this->user->id],
                    [
                        'phone_number' => $this->form->phone,
                        'profile_photo' => $this->form->profilePhoto,
                    ]
                );

            });

            session()->flash('alert', [
                'type' => 'green',
                'title' => 'Berhasil!',
                'message' => 'Data profil berhasil diperbarui.',
            ]);

        }, 'Gagal memperbarui data profil. Silakan coba lagi.', [
            'user_id' => auth()->id(),
            'action' => 'update_profile',
        ]);
    }

    public function render()
    {
        return view('livewire.pages.account.setting');
    }
}
