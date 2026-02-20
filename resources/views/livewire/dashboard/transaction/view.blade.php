<div class="shadow-xs">

    <div class="mb-2 flex items-center gap-x-2">
        <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Transaksi #{{ $data->invoice_number }}
        </h2>

        @php
            $totalPrice = 0;
        @endphp

        <span
            class="{{ $this->setStatus($data->order_status) ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }} inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium">
            {{ $data->order_status_description['description'] }}
        </span>

        @if ($data->order_status == 0 && $data->payment_proof)
            <span
                class="inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                Menunggu Verifikasi
            </span>
        @endif
    </div>

    <div
        class="mb-4 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 sm:space-y-2 dark:border-gray-700 dark:bg-gray-800">
        <dl class="items-start justify-between gap-4 sm:flex">
            <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Tanggal</dt>
            <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                {{ \Carbon\Carbon::parse($data->created_at)->locale('id')->format('d-m-Y H:m:s') }}
            </dd>
        </dl>
        <dl class="items-start justify-between gap-4 sm:flex">
            <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Bukti Pembayaran
            </dt>
            <dd class="flex gap-x-2 font-medium text-gray-900 sm:text-end dark:text-white">

                @forelse ($data->payment_proof as $proof)
                    <img id="img" data-url="{{ route('file.stream', ['path' => $proof['url']]) }}"
                        src="{{ route('file.stream', ['path' => $proof['url']]) }}" class="w-16">
                @empty
                    <span class="text-red-500">Belum ada bukti pembayaran</span>
                @endforelse

            </dd>
        </dl>
        <dl class="items-start justify-between gap-4 sm:flex">
            <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">
                Nama Penerima
            </dt>
            <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                {{ $data->user->profile->primaryAddress->receiver_name }}
            </dd>
        </dl>
        <dl class="items-start justify-between gap-4 sm:flex">
            <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">
                Alamat
            </dt>
            <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                {{ $data->user->profile?->primaryAddress?->address_name }}
                ({{ $data->user->profile?->primaryAddress?->address_detail }},
                {{ $data->user->profile?->primaryAddress?->city }},
                {{ $data->user->profile?->primaryAddress?->province }},
                {{ $data->user->profile?->primaryAddress?->country }},
                {{ $data->user->profile?->primaryAddress?->postal_code }})
            </dd>
        </dl>

        <dl class="items-start justify-between gap-4 sm:flex">
            <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">
                Jasa Kirim
            </dt>
            <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                {{ \App\Helpers\JasaKirim::jasaKirimName($data->shipping_service) }}
                (No resi: {{ $data->resi_number }})
            </dd>
        </dl>
        <dl class="items-start justify-between gap-4 sm:flex">
            <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">
                Telepon Penerima
            </dt>
            <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                {{ $data->user->profile->primaryAddress->receiver_phone }}
            </dd>
        </dl>
    </div>

    {{-- products --}}
    <div
        class="mb-4 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 sm:space-y-2 dark:border-gray-700 dark:bg-gray-800">
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

                                    <img class="h-auto max-h-full w-full object-cover"
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
                        <td colspan="3" class="whitespace-nowrap py-4 text-center text-gray-500 dark:text-gray-400">
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

                    @if ($data->usedPoints->count() > 0)
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-red-500 dark:text-red-400">Potongan Dari Poin</dt>
                            <dd class="text-base font-medium text-red-500">
                                - Rp. {{ number_format($data->usedPoints->first()->point_used, 2, ',', '.') }}
                            </dd>
                        </dl>
                    @endif

                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500 dark:text-gray-400">Biaya Jasa Kirim</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. 0</dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-yellow-500 dark:text-yellow-400">Estimasi Poin Yang Didapat</dt>
                        <dd class="text-base font-medium text-yellow-900 dark:text-yellow-300">
                            + {{ number_format($totalPrice * config('crm.point_percentage.point'), 0, ',', '.') }} Poin
                        </dd>
                    </dl>
                </div>

                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                    <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                    <dd class="text-lg font-bold text-gray-900 dark:text-white">Rp.
                        {{ number_format($totalPrice, 2, ',', '.') }}</dd>
                </dl>
            </div>
        </div>

    </div>
    {{-- end products --}}

    @if ($data->order_status === 0)
        {{-- action --}}
        <div class="flex items-center space-x-4">

            <flux:button variant="primary" color="green"
                wire:confirm.prompt="Apakah Anda yakin ingin konfirmasi transaksi ini?\nSebelum konfirmasi, silahkan cek ulang bukti pembayaran.\nJika sudah, ketik YA untuk konfirmasi.|YA"
                wire:click.prevent="confirmPayment({{ $data->id }})">
                Konfirmasi Pembayaran
            </flux:button>

            <flux:button variant="primary" color="red"
                wire:confirm.prompt="Apakah Anda yakin ingin tolak transaksi ini?\nTransaksi yang ditolak tidak dapat dikembalikan.\nJika yakin, ketik TOLAK untuk menolak transaksi.|TOLAK"
                wire:click.prevent="declinePayment({{ $data->id }})">
                Tolak Pembayaran
            </flux:button>

        </div>
    @endif
    {{-- end action --}}
</div>
