<div class="mx-auto w-full max-w-screen-xl p-4 lg:p-8">
    <div class="mb-6">
        @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Alamat saya'])

        <h2 class="mt-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Alamat Saya</h2>

    </div>

    <section class="rounded-lg bg-white p-8 antialiased shadow dark:bg-gray-900">
        @if (session('alert'))
            <x-utils.alert :color="session('alert')['type']" :title="session('alert')['title'] ?? 'Gagal'">
                {{ session('alert')['message'] ?? 'Terjadi kesalahan saat menyimpan data.' }}
            </x-utils.alert>
        @endif

        <div class="flex w-full items-center justify-end space-x-4">
            <button type="button"
                class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                wire:click.prevent="$set('showAddModal',true)">
                Tambah Alamat
            </button>
        </div>

        @forelse($addresses as $row)
            <div class="w-full px-4 2xl:px-0">
                <h2
                    class="mb-2 flex items-center gap-x-2 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    {{ $row->address_name ?? 'N/A' }}

                    @if (auth()->user()->profile?->primaryAddress->id === $row->id)
                        <span class="rounded bg-gray-200 px-2 py-0.5 text-xs">Utama</span>
                    @endif
                </h2>
                <p class="mb-6 text-gray-500 md:mb-8 dark:text-gray-400">
                    {{ $row->address_detail ?? 'N/A' }}
                </p>
                <div
                    class="mb-6 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 sm:space-y-2 md:mb-8 dark:border-gray-700 dark:bg-gray-800">
                    <dl class="items-center justify-between gap-4 sm:flex">
                        <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Nama Penerima</dt>
                        <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                            {{ $row->receiver_name ?? 'N/A' }}</dd>
                    </dl>
                    <dl class="items-center justify-between gap-4 sm:flex">
                        <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Telepon Penerima</dt>
                        <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                            {{ $row->receiver_phone ?? 'N/A' }}</dd>
                    </dl>
                    <dl class="items-center justify-between gap-4 sm:flex">
                        <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">
                            Kota
                        </dt>
                        <dd class="font-medium text-gray-900 sm:text-end dark:text-white">{{ $row->city ?? 'N/A' }}</dd>
                    </dl>
                    <dl class="items-center justify-between gap-4 sm:flex">
                        <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Provinsi</dt>
                        <dd class="font-medium text-gray-900 sm:text-end dark:text-white">{{ $row->province ?? 'N/A' }}
                        </dd>
                    </dl>
                    <dl class="items-center justify-between gap-4 sm:flex">
                        <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Negara</dt>
                        <dd class="font-medium text-gray-900 sm:text-end dark:text-white">{{ $row->country ?? 'N/A' }}
                        </dd>
                    </dl>
                </div>

                <div class="flex justify-end gap-x-2">
                    @if (auth()->user()->profile?->primaryAddress->id != $row->id)
                        <x-button.primary wire:click="makePrimary({{ $row->id }})" class="text-sm">
                            Jadikan Alamat Utama
                        </x-button.primary>
                    @endif

                    <x-button.danger wire:click="deleteAddress({{ $row->id }})" class="text-sm"
                        wire:confirm.prompt="Yakin ingin menghapus?\nKetik YA jika anda yakin|YA">
                        Hapus
                    </x-button.danger>
                </div>

            </div>
        @empty
            <p class="text-md text-center font-semibold text-gray-800">
                Belum Ada Alamat
            </p>
        @endforelse

        {{-- add modal --}}
        <div id="addAddressModal" wire:show="showAddModal" wire:transition
            class="fixed inset-0 z-[99] flex items-center justify-center bg-black/70 bg-opacity-70 py-8">
            @if ($showAddModal)
                <div class="relative mx-4 my-6 flex w-full flex-col gap-1 overflow-y-auto rounded-xl bg-white p-4 shadow-2xl md:w-2/3 md:gap-2 lg:w-1/2 xl:w-2/5 dark:bg-gray-700"
                    style="max-height: calc(100vh - 6rem);">
                    <!-- Modal header -->
                    <div class="border-default flex items-center justify-between border-b pb-4 md:pb-5">
                        <h3 class="text-heading text-lg font-medium">
                            Tambah Alamat Baru
                        </h3>
                        <button type="button"
                            class="text-body hover:bg-neutral-tertiary hover:text-heading rounded-base ms-auto inline-flex h-9 w-9 items-center justify-center bg-transparent text-sm"
                            wire:click.prevent="$set('showAddModal', false)">
                            <x-icons.close class="h-5 w-5" />
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="space-y-4 py-4 md:space-y-6 md:py-6">

                        <x-input.basic id="nama_alamat" label="Nama Alamat" placeholder="Ketik nama alamat..."
                            type="text" wire:model="form.address_name" errorName="form.address_name" />

                        <x-input.basic id="kota" label="Kota" placeholder="Ketik nama kota..." type="text"
                            wire:model="form.city" errorName="form.city" />

                        <x-input.basic id="provinsi" label="Provinsi" placeholder="Ketik nama provinsi..."
                            type="text" wire:model="form.province" errorName="form.province" />

                        <x-input.basic id="negara" label="Negara" placeholder="Ketik nama negara..." type="text"
                            wire:model="form.country" errorName="form.country" />

                        <x-input.basic id="kode_pos" label="Kode Pos" placeholder="Ketik kode pos daerah..."
                            type="text" wire:model="form.postal_code" errorName="form.postal_code" />

                        <x-input.basic id="nama_penerima" label="Nama Penerima" placeholder="Ketik nama penerima..."
                            type="text" wire:model="form.receiver_name" errorName="form.receiver_name" />

                        <x-input.basic id="no_telpon" label="No Telepon" placeholder="085833xxxxx" type="text"
                            wire:model="form.receiver_phone" errorName="form.receiver_phone" />

                        <x-input.text-area id="deskripsi" label="Deskripsi" placeholder="Deskripsi alamat..."
                            wire:model="form.description" errorName="form.description" />

                    </div>

                    <!-- Modal footer -->
                    <div class="border-default flex items-center space-x-4 border-t pt-4 md:pt-5">
                        <button wire:click="addAddressProcess" type="button"
                            class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                            Simpan
                        </button>

                        <button type="button"
                            class="border-default-medium shadow-xs rounded-base box-border border bg-red-500 px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-400"
                            wire:click="$set('showAddModal', false)">Batal </button>
                    </div>
            @endif
        </div>
        {{-- end add modal --}}

    </section>
</div>
