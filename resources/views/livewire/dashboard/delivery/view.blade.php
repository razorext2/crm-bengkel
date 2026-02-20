<div class="grid grid-cols-1 gap-2 lg:grid-cols-2 lg:gap-4">
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
                    {{ $data->created_at->format('d, M Y H:i:s') }}
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
                                        {{ $item->product->product_name }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="whitespace-nowrap py-4 text-center text-gray-500 dark:text-gray-400">
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

                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-yellow-500 dark:text-yellow-400">Estimasi Poin Yang Didapat</dt>
                            <dd class="text-base font-medium text-yellow-900 dark:text-yellow-300">
                                + {{ number_format($totalPrice * config('crm.point_percentage.point'), 0, ',', '.') }}
                                Poin
                            </dd>
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
    </div>

    <form wire:submit.prevent="store" class="flex h-fit w-full flex-col">

        <div class="mb-2 flex items-center gap-x-2">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                Update Pengiriman
            </h2>
        </div>

        <div
            class="mb-4 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">

            @if (!$data->is_delivered)
                <flux:select label="Pilih Jasa Kirim" wire:model="form.shipping_service">
                    <flux:select.option>
                        Pilih jasa kirim...
                    </flux:select.option>
                    @forelse (config('crm.jasa_kirm') as $row)
                        <flux:select.option value="{{ $row['id'] }}">
                            {{ $row['name'] }}
                        </flux:select.option>
                    @empty
                        <p class="text-gray-800">Belum ada kategori yang ditambahkan.</p>
                    @endforelse
                </flux:select>

                <flux:input type="text" label="Nomor Resi" wire:model="form.resi_number"
                    placeholder="Input nomor resi..." />

                <flux:input type="number" min="0" placeholder="Input biaya pengiriman..."
                    label="Biaya Pengiriman" wire:model="form.shipping_cost" />

                <div class="mt-2 flex justify-start">
                    <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
                        Perbarui Pengiriman
                    </flux:button>
                </div>
            @else
                <ul role="list" class="space-y-4">
                    <li class="flex items-center">
                        <x-icons.check class="text-fg-brand me-1.5 h-5 w-5 shrink-0" />
                        <span class="text-body dark:text-white">
                            Pesanan dibuat
                            {{ \Carbon\Carbon::parse($data->created_at)->format('D, M Y H:I:s') }}.
                        </span>
                    </li>
                    @if (!empty($data->payment_proof))
                        <li class="flex items-center">
                            <x-icons.check class="text-fg-brand me-1.5 h-5 w-5 shrink-0" />
                            <span class="text-body dark:text-white">
                                Pembayaran telah dilakukan.
                            </span>
                        </li>
                    @endif
                    @if ($data->is_delivered)
                        <li class="flex items-center">
                            <x-icons.check class="text-fg-brand me-1.5 h-5 w-5 shrink-0" />
                            <span class="text-body dark:text-white">
                                Pengiriman telah dilakukan
                                {{ \Carbon\Carbon::parse($data->delivered_at)->format('D, M Y H:I:s') }}.
                            </span>
                        </li>
                    @endif
                    @if ($data->is_completed)
                        <li class="flex items-center">
                            <x-icons.check class="text-fg-brand me-1.5 h-5 w-5 shrink-0" />
                            <span class="text-body dark:text-white">
                                Pesanan telah diselesaikan pada
                                {{ \Carbon\Carbon::parse($data->completed_at)->format('D, M Y H:I:s') }}.
                            </span>
                        </li>
                    @endif
                </ul>

                @if ($data->is_completed === 0 && $data->order_status === 3)
                    <flux:button type="submit" variant="primary" color="green"
                        wire:confirm.prompt="Jika pesanan diselesaikan, estimasi poin akan diteruskan ke customer.\nKetik YA untuk menyelesaikan pesanan.|YA"
                        wire:click.prevent="markAsCompleted({{ $data->id }})">
                        Tandai Transaksi Selesai
                    </flux:button>
                @endif
            @endif
        </div>
    </form>
</div>
