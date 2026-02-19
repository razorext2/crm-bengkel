<?php

use Livewire\Component;

new class extends Component {
    use App\Livewire\Concerns\HandlesErrors;

    public ?string $name;
    public ?string $email;
    public ?string $phone;
    public ?string $password;
    public ?string $password_confirmation;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }

    public function register()
    {
        // validasi input dari frontend
        $this->validate();

        $this->runSafely(
            function () {
                DB::transaction(function () {
                    // tambah data user dan customer profile
                    $user = App\Models\User::create([
                        'name' => $this->name,
                        'email' => $this->email,
                        'password' => Hash::make($this->password),
                        'is_admin' => 0,
                    ]);

                    // tambah data customer profile
                    App\Models\CustomerProfile::create([
                        'user_id' => $user->id,
                        'phone_number' => $this->phone,
                        'profile_photo' => null,
                        'points' => 0,
                    ]);

                    // munculkan session alert
                    $this->dispatch('swal', [
                        'icon' => 'success',
                        'title' => 'Berhasil!',
                        'text' => 'Akun berhasil dibuat, silahkan login untuk melanjutkan.',
                    ]);

                    // reset form field
                    $this->redirectRoute('login');
                });
            },
            'Terjadi kesalahan saat membuat akun.',
            [
                'data' => $this->all(),
            ],
        );
    }
};
?>

<div class="mx-auto max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Login', 'subpage' => ''])

    <section class="rounded-lg bg-white antialiased shadow-lg dark:bg-gray-900">
        <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 lg:py-16">
            <a href="#" class="mb-6 flex items-center text-gray-900 dark:text-white">
                <h1 class="text-2xl font-extrabold text-red-700"> MolJaya<span class="font-semibold italic">Motor
                    </span>
                </h1>
            </a>
            <div
                class="w-full rounded-lg bg-white shadow sm:max-w-md md:mt-0 xl:p-0 dark:border dark:border-gray-700 dark:bg-gray-800">
                <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Buat akun anda.
                    </h1>

                    @if (session('alert'))
                        <x-utils.alert :color="session('alert')['type']" :title="session('alert')['title']">

                            {{ session('alert')['message'] }}

                        </x-utils.alert>
                    @endif

                    <form class="space-y-4 md:space-y-6" wire:submit.prevent="register">
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Nama Kamu
                            </label>
                            <input type="text" name="name" id="name"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="Mr/Mrs Siapa" wire:model.live="name">

                            @error('name')
                                <p class="mt-2 text-sm italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="customer@email.com" wire:model.live="email">

                            @error('email')
                                <p class="mt-2 text-sm italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                No. Telepon
                            </label>
                            <input type="text" name="phone" id="phone"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="08xx-xxxx-xxxx" wire:model.live="phone">

                            @error('phone')
                                <p class="mt-2 text-sm italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                wire:model="password">

                            @error('password')
                                <p class="mt-2 text-sm italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password-confirmation"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation" id="password-confirmation"
                                placeholder="••••••••"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                wire:model="password_confirmation">

                            @error('password_confirmation')
                                <p class="mt-2 text-sm italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="flex items-center justify-between">
                            <a href="#"
                                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot
                                password?</a>
                        </div> --}}

                        <button type="submit"
                            class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Daftar
                        </button>

                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Sudah punya akun? <a href="{{ route('login') }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                                Masuk
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

    </section>

</div>
