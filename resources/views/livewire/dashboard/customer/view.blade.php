<div class="flex flex-col gap-4 lg:flex-row">

    <div class="flex flex-col gap-2 lg:gap-4">
        {{-- customer profile info --}}
        <div
            class="border-default rounded-base shadow-xs flex h-fit flex-col border bg-gray-400 md:flex-row lg:flex-1 dark:bg-gray-700">
            <div class="shrink-0 md:w-44">
                <img class="rounded-base md:rounded-l-base h-full w-full object-cover md:rounded-none"
                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="">
            </div>
            <div class="flex grow flex-col justify-between p-4 leading-normal lg:p-6">
                <h5 class="text-heading text-2xl font-bold tracking-tight">
                    {{ $user->name }}
                </h5>
                <p class="mb-2 text-sm"> {{ $user->email }}</p>

                <div class="w-full">
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500 dark:text-gray-400">No. Telepon</dt>
                        <dd class="text-righ text-base font-medium text-gray-900 dark:text-white">
                            {{ $user->profile->phone_number }}
                        </dd>
                    </dl>
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500 dark:text-gray-400">Alamat Utama</dt>
                        <dd class="text-right text-base font-medium text-gray-900 dark:text-white">
                            {{ $user->profile->primaryAddress->address_detail }}
                        </dd>
                    </dl>
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500 dark:text-gray-400">Poin</dt>
                        <dd class="text-right text-base font-medium text-gray-900 dark:text-white">
                            {{ $user->profile->points }} Poin
                        </dd>
                    </dl>
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500 dark:text-gray-400">Total Transaksi</dt>
                        <dd class="text-right text-base font-medium text-gray-900 dark:text-white">
                            {{ $user->transactions->count() }} Kali
                        </dd>
                    </dl>
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500 dark:text-gray-400">Total Ulasan</dt>
                        <dd class="text-right text-base font-medium text-gray-900 dark:text-white">
                            {{ $user->review->count() }} Ulasan
                        </dd>
                    </dl>
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500 dark:text-gray-400">Produk Disimpan</dt>
                        <dd class="text-right text-base font-medium text-gray-900 dark:text-white">
                            {{ $user->favorites->count() ?? 'N/A' }} Produk
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        {{-- end customer profile --}}

        {{-- latest point history --}}
        <div
            class="border-default rounded-base shadow-xs h-fit border bg-gray-400 p-4 lg:flex-1 lg:p-6 dark:bg-gray-700">
            <div class="mb-4 flex items-center justify-between">
                <h5 class="text-heading text-xl font-semibold leading-none">5 Riwayat Transaksi Poin</h5>
                {{-- <a href="#" class="text-fg-brand font-medium hover:underline">View all</a> --}}
            </div>

            <div class="flow-root">
                <ul role="list" class="divide-default divide-y">
                    @forelse($user->pointHistories->take(5)->reverse() as $row)
                        <li class="py-4 sm:py-4">
                            <div class="flex items-center gap-2">
                                <div class="min-w-0 flex-1">
                                    <p class="text-heading truncate font-medium">
                                        #{{ $row->transaction->invoice_number }}
                                    </p>

                                    <p
                                        class="{{ $row->point_get ? 'text-green-500' : 'text-red-500' }} truncate text-sm">
                                        {{ $row->point_get ? 'Mendapatkan ' : 'Menggunakan ' }}
                                        {{ number_format($row->point_get ? $row->point_get : $row->point_used, '0', ',', '.') }}
                                        Poin
                                    </p>
                                </div>
                                <div class="text-heading inline-flex items-center text-sm font-medium">
                                    {{ $row->created_at->format('D, d M Y H:i:s') }}
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-4 sm:py-4">
                            <p class="text-body text-sm">Belum ada history poin</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        {{-- end latest point history --}}
    </div>

    <div class="flex flex-1 flex-col gap-2 lg:gap-4">
        {{-- latest transactions --}}
        <div
            class="border-default rounded-base shadow-xs h-fit border bg-gray-400 p-4 lg:flex-1 lg:p-6 dark:bg-gray-700">
            <div class="mb-4 flex items-center justify-between">
                <h5 class="text-heading text-xl font-semibold leading-none">5 Transaksi Terakhir</h5>
                {{-- <a href="#" class="text-fg-brand font-medium hover:underline">View all</a> --}}
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-default divide-y">
                    @forelse($user->transactions->take(5)->reverse() as $row)
                        <li class="py-4 sm:py-4">
                            <div class="flex items-center gap-2">
                                <div class="min-w-0 flex-1">
                                    <p class="text-heading truncate font-medium">
                                        #{{ $row->invoice_number }}
                                    </p>

                                    <div class="text-body my-1">
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
                                            class="{{ $statusColors[$row->order_status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }} inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium">
                                            {{ $row->order_status_description['description'] }}
                                        </dd>

                                        @if ($row->order_status == 0 && $row->payment_proof)
                                            <dd
                                                class="inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                Menunggu Verifikasi
                                            </dd>
                                        @endif
                                    </div>

                                    <p class="text-body truncate text-sm">
                                        Rp. {{ number_format($row->total_amount, '2', ',', '.') }}
                                    </p>
                                </div>
                                <div class="text-heading inline-flex items-center font-medium">
                                    {{ $row->created_at->format('D, d M Y H:i:s') }}
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-4 sm:py-4">
                            <p class="text-body text-sm">Belum ada transaksi</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        {{-- end latest transactions --}}

        {{-- latest reviews --}}
        <div
            class="border-default rounded-base shadow-xs h-fit border bg-gray-400 p-4 lg:flex-1 lg:p-6 dark:bg-gray-700">
            <div class="mb-4 flex items-center justify-between">
                <h5 class="text-heading text-xl font-semibold leading-none">5 Ulasan Terakhir</h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-default divide-y">
                    @forelse($user->review->take(5) as $row)
                        <li class="py-4 sm:py-4">
                            <div class="flex items-center gap-2">
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('product.edit', $row->product->id) }}"
                                        class="text-heading truncate font-medium hover:underline">
                                        {{ $row->product->product_name }}
                                    </a>

                                    <p class="text-body truncate text-sm">
                                        {{ $row->review }}
                                    </p>
                                </div>
                                <div class="text-heading items-center font-medium">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <x-icons.star
                                                class="{{ $row->rating >= $i ? 'text-yellow-400' : 'text-gray-400' }} h-5 w-5" />
                                        @endfor
                                    </div>
                                    <p>{{ $row->created_at->format('D, d M Y H:i:s') }}</p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-4 sm:py-4">
                            <p class="text-body text-sm">Belum ada ulasan dari pelanggan ini.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        {{-- end latest reviews --}}
    </div>
</div>
