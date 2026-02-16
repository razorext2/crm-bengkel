<div class="mx-auto w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Pengaturan'])

    <section class="rounded-lg border border-gray-200 bg-white p-2 antialiased shadow-md lg:p-4 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">

            <h2 class="mb-4 text-xl font-semibold text-gray-900 sm:text-2xl md:mb-6 dark:text-white">
                Akun Saya
            </h2>

            <div class="py-4">
                <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                    <div class="space-y-4">
                        <div class="flex space-x-4">
                            <img class="h-16 w-16 rounded-lg"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png"
                                alt="Helene avatar" />
                            <div class="flex flex-col gap-2">
                                <span
                                    class="mb-2 inline-block w-fit rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    Level Basic
                                </span>

                                <h2
                                    class="flex items-center text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">
                                    {{ $user->name }}
                                </h2>
                            </div>
                        </div>
                        <dl class="">
                            <dt class="font-semibold text-gray-900 dark:text-white">Alamat Email</dt>
                            <dd class="text-gray-500 dark:text-gray-400">{{ $user->email }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 dark:text-white">Alamat Default</dt>
                            <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                                <x-icons.home
                                    class="hidden h-5 w-5 shrink-0 text-gray-400 lg:inline dark:text-gray-500" />
                                {{ $user->addresses?->first()?->address_detail ?? 'Belum ada alamat' }}
                            </dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 dark:text-white">
                                Alamat Pengiriman
                            </dt>
                            <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                                <x-icons.trucks
                                    class="hidden h-5 w-5 shrink-0 text-gray-400 lg:inline dark:text-gray-500" />
                                {{ $user->addresses?->first()?->address_detail ?? 'Belum ada alamat pengiriman' }}
                            </dd>
                        </dl>
                    </div>
                    <div class="space-y-4">
                        <dl>
                            <dt class="font-semibold text-gray-900 dark:text-white">No. Telepon</dt>
                            <dd class="text-gray-500 dark:text-gray-400">
                                {{ $user->profile->phone_number ?? 'Belum diatur' }}
                            </dd>
                        </dl>
                    </div>
                </div>
                <button type="button" wire:click.prevent="$set('showEditProfileModal', true)"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <x-icons.pencil-with-square class="-ms-0.5 me-1.5 h-4 w-4" />
                    Edit your data
                </button>
            </div>

        </div>

    </section>

    {{-- add modal --}}
    <div id="editProfileModal" wire:show="showEditProfileModal" wire:transition
        class="fixed inset-0 z-[99] flex items-center justify-center bg-black/70 bg-opacity-70 py-8">
        @if ($showEditProfileModal)
            <div class="relative mx-4 my-6 flex w-full flex-col gap-1 overflow-y-auto rounded-xl bg-white p-4 shadow-2xl md:w-2/3 md:gap-2 lg:w-1/2 xl:w-2/5 dark:bg-gray-700"
                style="max-height: calc(100vh - 6rem);">
                <!-- Modal header -->
                <form wire:submit.prevent="store" autocomplete="off">
                    <div class="border-default flex items-center justify-between border-b pb-4 md:pb-5">
                        <h3 class="text-heading text-lg font-medium">
                            Tambah Alamat Baru
                        </h3>
                        <button type="button"
                            class="text-body hover:bg-neutral-tertiary hover:text-heading rounded-base ms-auto inline-flex h-9 w-9 items-center justify-center bg-transparent text-sm"
                            wire:click.prevent="$set('showEditProfileModal', false)">
                            <x-icons.close class="h-5 w-5" />
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="space-y-4 py-4 md:space-y-6 md:py-6">

                        @if (session('alert'))
                            <x-utils.alert :color="session('alert')['type']" :title="session('alert')['title'] ?? 'Gagal'">
                                {{ session('alert')['message'] ?? 'Terjadi kesalahan saat menyimpan data.' }}
                            </x-utils.alert>
                        @endif

                        <x-input.basic id="name" label="Nama Anda" placeholder="Ketik nama Anda..." type="text"
                            wire:model="form.name" errorName="form.name" />

                        <x-input.basic id="phone" label="No. Telepon" placeholder="Ketik nomor telepon Anda..."
                            type="text" wire:model="form.phone" errorName="form.phone" autocomplete="off" />

                        <x-input.basic id="new_password" label="Password Baru" placeholder="Ketik password baru Anda..."
                            type="password" wire:model="form.new_password" errorName="form.new_password"
                            autocomplete="off" />

                        <x-input.basic id="new_password_confirmation" label="Konfirmasi Password Baru"
                            placeholder="Ketik ulang password baru Anda..." type="password"
                            wire:model="form.new_password_confirmation" errorName="form.new_password_confirmation" />
                    </div>

                    <!-- Modal footer -->
                    <div class="border-default flex items-center space-x-4 border-t pt-4 md:pt-5">
                        <button type="submit"
                            class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                            Simpan
                        </button>

                        <button type="button"
                            class="border-default-medium shadow-xs rounded-base box-border border bg-red-500 px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-400"
                            wire:click="$set('showEditProfileModal', false)">Batal </button>
                    </div>
                </form>
        @endif
    </div>
    {{-- end add modal --}}
</div>
