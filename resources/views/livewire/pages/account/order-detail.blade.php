<div class="mx-auto min-h-max w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Pesanan Saya'])

    <section
        class="rounded-lg border border-gray-200 bg-white p-2 antialiased shadow-md md:py-16 lg:p-4 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl p-8">

            <h2 class="mb-2 flex items-center gap-x-2 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                Detail Pesanan #{{ $data->invoice_number }}

                @php
                    $totalPrice = 0;

                    $statusColors = [
                        0 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                        1 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                        2 => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                        3 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                        4 => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                    ];
                @endphp

                <dd
                    class="{{ $statusColors[$data->order_status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }} me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium">
                    {{ $data->order_status_description['description'] }}
                </dd>
                @if ($data->order_status == 0 && $data->payment_proof)
                    <dd
                        class="me-2 mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                        Menunggu Verifikasi
                    </dd>
                @endif
            </h2>

            <div
                class="mb-6 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 sm:space-y-2 md:mb-8 dark:border-gray-700 dark:bg-gray-800">
                <dl class="items-start justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Tanggal</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ \Carbon\Carbon::parse($data->created_at)->locale('id')->format('d-m-Y H:m:s') }}
                    </dd>
                </dl>
                <dl class="items-start justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Bukti Pembayaran
                    </dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        @if (empty($data->payment_proof))
                            <span class="text-red-500">Belum ada bukti pembayaran</span>

                            <x-button.primary wire:click="$set('showPaymentProofModal', true)">
                                Upload Bukti Pembayaran
                            </x-button.primary>
                        @else
                            <div class="flex gap-x-2">
                                @foreach ($data->payment_proof as $proof)
                                    <img id="img" data-url="{{ route('file.stream', ['path' => $proof['url']]) }}"
                                        src="{{ route('file.stream', ['path' => $proof['url']]) }}" class="w-16">
                                @endforeach
                            </div>
                        @endif
                    </dd>
                </dl>
                <dl class="items-start justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Nama Penerima</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ auth()->user()->profile->primaryAddress->receiver_name }}
                    </dd>
                </dl>
                <dl class="items-start justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Alamat</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ auth()->user()->profile?->primaryAddress?->address_name }}
                        ({{ auth()->user()->profile?->primaryAddress?->address_detail }},
                        {{ auth()->user()->profile?->primaryAddress?->city }},
                        {{ auth()->user()->profile?->primaryAddress?->province }},
                        {{ auth()->user()->profile?->primaryAddress?->country }},
                        {{ auth()->user()->profile?->primaryAddress?->postal_code }})
                    </dd>
                </dl>
                <dl class="items-start justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Jasa Kirim</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ \App\Helpers\JasaKirim::jasaKirimName($data->shipping_service) }}
                        (No resi: {{ $data->resi_number }})
                    </dd>
                </dl>
                <dl class="items-start justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Telepon Penerima</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ auth()->user()->profile->primaryAddress->receiver_phone }}
                    </dd>
                </dl>
            </div>

            {{-- products --}}
            <div
                class="mb-6 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 sm:space-y-2 md:mb-8 dark:border-gray-700 dark:bg-gray-800">
                <h2 class="mb-2 flex items-center gap-x-2 text-lg font-semibold text-gray-900 dark:text-white">
                    Detail Produk
                </h2>

                <table class="w-full text-left font-medium text-gray-900 md:table-fixed dark:text-white">
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                        @forelse ($data->transactionDetail as $item)
                            @php
                                $totalProductPrice = $item->quantity * $item->product->price;
                                $totalPrice += $totalProductPrice;
                            @endphp
                            <tr>
                                <td class="whitespace-nowrap py-4 md:w-[384px]">
                                    <div class="flex items-center gap-4">
                                        <a href="#" class="flex aspect-square h-10 w-10 shrink-0 items-center">

                                            <img class="h-auto max-h-full w-full dark:hidden"
                                                src="{{ asset('storage/' . $item->product->product_image_primary) }}"
                                                alt="imac image" />

                                        </a>
                                        <a href="{{ route('product.detail', $item->product->id) }}" class="text-wrap">
                                            {{ $item->product->product_name }},
                                            Rp. {{ number_format($item->product->price, 2, ',', '.') }}
                                        </a>
                                    </div>
                                </td>

                                <td class="p-4 text-base font-normal text-gray-900 dark:text-white">
                                    x{{ $item->quantity }}
                                </td>

                                <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">
                                    Rp. {{ number_format($totalProductPrice, 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="whitespace-nowrap py-4 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada produk.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                <div class="mt-4 space-y-6">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</h4>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-gray-500 dark:text-gray-400">Harga Total</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">Rp.
                                    {{ number_format($totalPrice, 2, ',', '.') }}
                                </dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-gray-500 dark:text-gray-400">Diskon</dt>
                                <dd class="text-base font-medium text-green-500">-</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-gray-500 dark:text-gray-400">Biaya Jasa Kirim</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. 0</dd>
                            </dl>

                        </div>

                        <dl
                            class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="text-lg font-bold text-gray-900 dark:text-white">Rp.
                                {{ number_format($totalPrice, 2, ',', '.') }}</dd>
                        </dl>
                    </div>
                </div>

            </div>
            {{-- end products --}}

            {{-- action --}}
            <div class="flex items-center space-x-2">
                <a href="{{ route('account.order') }}"
                    class="rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Kembali
                </a>

                @if ($data->order_status === 2)
                    <button
                        wire:confirm.prompt="Apakah anda benar benar sudah memastikan pesanan telah tiba?\nKetik YA jika sudah dikonfirmasi.|YA"
                        wire:click.prevent="hasArrived({{ $data->id }})"
                        class="rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Pesanan Diterima
                    </button>
                @endif

                @if ($data->shipping_service !== 'jskrmtk')
                    <a href="{{ \App\Helpers\JasaKirim::jasaKirimUrl($data->shipping_service) }}"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        target="_blank">
                        Track your order
                    </a>
                @endif
            </div>
            {{-- end action --}}
        </div>

    </section>

    {{-- payment proof modal --}}
    <div id="paymentProofModal" wire:show="showPaymentProofModal" wire:transition
        class="fixed inset-0 z-[99] flex items-center justify-center bg-black/70 bg-opacity-70 py-8">
        @if ($showPaymentProofModal)
            <div class="relative mx-4 my-6 flex w-full flex-col gap-1 overflow-y-auto rounded-xl bg-white p-4 shadow-2xl md:w-2/3 md:gap-2 lg:w-1/2 xl:w-2/5 dark:bg-gray-700"
                style="max-height: calc(100vh - 6rem);">
                <!-- Modal header -->
                <form wire:submit.prevent="store" autocomplete="off">
                    <div class="border-default flex items-center justify-between border-b pb-4 md:pb-5">
                        <h3 class="text-heading text-lg font-medium">
                            Tambah Bukti Pembayaran
                        </h3>
                        <button type="button"
                            class="text-body hover:bg-neutral-tertiary hover:text-heading rounded-base ms-auto inline-flex h-9 w-9 items-center justify-center bg-transparent text-sm"
                            wire:click.prevent="$set('showPaymentProofModal', false)">
                            <x-icons.close class="h-5 w-5" />
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="space-y-4 py-4 md:space-y-6 md:py-6">

                        <div x-show="$wire.docForm.new_attachments.length > 0">
                            <span class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Daftar Lampiran
                            </span>

                            <ul
                                class="divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-700">

                                @foreach ($docForm->new_attachments as $index => $row)
                                    <li
                                        class="flex items-center gap-2 p-2 transition hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <div
                                            class="w-8 text-center text-sm font-medium text-gray-600 dark:text-gray-400">
                                            {{ $index + 1 }}.
                                        </div>

                                        <div class="flex-1">
                                            <p class="text-base font-medium text-gray-900 dark:text-gray-100">
                                                {{ $row['nama_file'] }}
                                            </p>
                                        </div>

                                        <button type="button" wire:click="removeAttachment({{ $index }})"
                                            class="text-sm font-medium text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            Hapus
                                        </button>
                                    </li>
                                @endforeach

                            </ul>

                            @error('docForm.new_attachments.*')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                for="attachment">Lampiran</label>

                            <div class="flex w-full flex-col gap-y-2" x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <label for="attachment"
                                    class="flex h-36 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 transition-all duration-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-800">
                                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                        <x-icons.cloud-upload class="mb-2 h-8 w-8 text-gray-500 dark:text-gray-400" />

                                        <p wire:loading.remove wire:target="docForm.attachment"
                                            class="mb-0.5 text-sm text-gray-500 dark:text-white"> Klik untuk upload
                                        </p>

                                        <p class="mb-0.5 text-sm text-gray-500 dark:text-gray-400">
                                            @if ($docForm->attachment)
                                                <span class="font-semibold dark:text-white">
                                                    {{ $docForm->attachment->getClientOriginalName() }}</span>
                                            @endif
                                        </p>

                                        <div x-show="uploading"
                                            class="mb-2 flex flex-col items-center gap-2 text-gray-800 dark:text-white">
                                            <span wire:target="docForm.attachment" class="font-semibold">
                                                Sedang Mengupload...</span>

                                            <x-button.danger id="cancel-upload" type="button" class="text-xs"
                                                wire:click="$cancelUpload('docForm.attachment')">
                                                Cancel
                                            </x-button.danger>
                                        </div>

                                        <p class="w-full text-center text-xs text-gray-500 dark:text-gray-400">
                                            *Dokumentasi dapat berupa file Gambar (Min 10KB, Maks
                                            2MB)
                                        </p>
                                    </div>
                                    <input id="attachment" name="attachment" type="file"
                                        wire:model="docForm.attachment" class="hidden"
                                        accept=".jpeg,.jpg,.bmp,.png,.heic" />
                                </label>

                                <div x-show="uploading" class="h-4 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                                    <div class="h-4 rounded-full bg-blue-600" x-bind:style="{ width: progress + '%' }">
                                    </div>
                                </div>

                            </div>

                            @error('docForm.attachment')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex w-full justify-end">
                            <x-button.primary id="add-attachment" wire:click="storeLampiran" type="button">
                                Tambah
                            </x-button.primary>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="border-default flex items-center space-x-4 border-t pt-4 md:pt-5">
                        <button type="submit"
                            class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                            Simpan
                        </button>

                        <button type="button"
                            class="border-default-medium shadow-xs rounded-base box-border border bg-red-500 px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-400"
                            wire:click="$set('showPaymentProofModal', false)">Batal </button>
                    </div>
                </form>
        @endif
    </div>
    {{-- end payment proof modal --}}
</div>
