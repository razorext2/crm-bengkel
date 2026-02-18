<div class="mx-auto min-h-max w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Pesanan Saya'])

    <section
        class="rounded-lg border border-gray-200 bg-white p-2 antialiased shadow-md md:py-16 lg:p-4 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Pesanan Saya</h2>
                </div>

                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">

                        @forelse ($transactions as $row)
                            <div class="flex flex-wrap items-center gap-y-4 py-6">
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">
                                        Kode Transaksi:
                                    </dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        <a href="#" class="hover:underline">#{{ $row->invoice_number }}</a>
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Carbon\Carbon::parse($row->created_at)->format('d M Y') }}
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Total Harga:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        Rp. {{ number_format($row->total_amount, 0, ',', '.') }}</dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    @php
                                        $statusColors = [
                                            0 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            1 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            2 => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            3 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                            4 => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                        ];
                                    @endphp

                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                                    <dd
                                        class="{{ $statusColors[$row->order_status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }} me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium">
                                        {{ $row->order_status_description['description'] }}
                                    </dd>
                                    @if ($row->order_status == 0 && $row->payment_proof)
                                        <dd
                                            class="me-2 mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            Menunggu Verifikasi
                                        </dd>
                                    @endif
                                </dl>

                                <div
                                    class="grid w-full gap-4 sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end">
                                    @if ($row->order_status != 4)
                                        <button type="button"
                                            wire:confirm.prompt="Apakah kamu yakin ingin membatalkan transaksi ini?\nKetik BATAL jika kamu yakin.|BATAL"
                                            wire:click.prevent="cancelTransaction({{ $row->id }})"
                                            class="w-full cursor-pointer rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 lg:w-auto dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                            Batalkan Pesanan
                                        </button>
                                    @endif

                                    <a href="{{ route('account.order.detail', $row->id) }}"
                                        class="inline-flex w-full justify-center rounded-lg border border-blue-200 bg-white px-3 py-2 text-sm font-medium text-blue-900 hover:bg-blue-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-100 lg:w-auto dark:border-blue-600 dark:bg-blue-800 dark:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white dark:focus:ring-blue-700">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-md text-center font-semibold">
                                Belum ada transaksi yang dilakukan.
                            </p>
                        @endforelse

                    </div>

                    {{ $transactions->links() }}
                </div>
            </div>
    </section>
</div>
