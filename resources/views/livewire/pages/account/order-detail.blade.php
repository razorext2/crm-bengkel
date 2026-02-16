<div class="mx-auto min-h-max w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Pesanan Saya'])

    @if (session('alert'))
        <x-utils.alert :color="session('alert')['type']" :title="session('alert')['title'] ?? 'Gagal'">
            {{ session('alert')['message'] ?? 'Terjadi kesalahan saat menyimpan data.' }}
        </x-utils.alert>
    @endif

    <section
        class="rounded-lg border border-gray-200 bg-white p-2 antialiased shadow-md md:py-16 lg:p-4 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl p-8">

            <h2 class="mb-2 flex items-center gap-x-2 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                Detail Pesanan #{{ $data->invoice_number }}

                @php
                    $totalPrice = 0;

                    $statusColors = [
                        0 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                        1 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                        2 => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                        3 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                        4 => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                    ];
                @endphp

                <dd
                    class="{{ $statusColors[$data->order_status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }} me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium">
                    {{ $data->order_status_description['description'] }}
                </dd>
            </h2>

            <div
                class="mb-6 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 sm:space-y-2 md:mb-8 dark:border-gray-700 dark:bg-gray-800">
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Tanggal</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ \Carbon\Carbon::parse($data->created_at)->locale('id')->format('d-m-Y H:m:s') }}
                    </dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Bukti Pembayaran</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        @if (empty($data->payment_proof))
                            <span class="text-red-500">Belum ada bukti pembayaran</span>
                        @endif
                    </dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Nama Penerima</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ auth()->user()->profile->primaryAddress->receiver_name }}
                    </dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 sm:mb-0 dark:text-gray-400">Alamat</dt>
                    <dd class="font-medium text-gray-900 sm:text-end dark:text-white">
                        {{ auth()->user()->profile->primaryAddress->address_name }}
                        ({{ auth()->user()->profile->primaryAddress->address_detail }},
                        {{ auth()->user()->profile->primaryAddress->city }},
                        {{ auth()->user()->profile->primaryAddress->province }},
                        {{ auth()->user()->profile->primaryAddress->country }},
                        {{ auth()->user()->profile->primaryAddress->postal_code }})
                    </dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
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
                                        <a href="{{ route('product.detail', $item->product->id) }}"
                                            class="hover:underline">
                                            {{ $item->product->product_name }}
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
            <div class="flex items-center space-x-4">
                <a href="{{ route('account.order') }}"
                    class="rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Kembali
                </a>

                <a href="#"
                    class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Track
                    your order</a>
            </div>
            {{-- end action --}}
        </div>

    </section>
</div>
