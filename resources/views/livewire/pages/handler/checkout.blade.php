<div class="mx-auto w-full max-w-screen-xl p-4 lg:p-8">
    <section class="py-8 antialiased md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>
                    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Favorit'])

                    <h2 class="mt-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Proses Checkout</h2>
                </div>
            </div>

            <section class="rounded-lg bg-white p-8 antialiased shadow lg:p-16 dark:bg-gray-900">
                <form wire:submit.prevent="processToCheckout" class="mx-auto w-full px-4 2xl:px-0">

                    <div class="space-y-4 border-b border-t border-gray-200 py-6 dark:border-gray-700">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Alamat Pengiriman
                        </h4>

                        <dl>
                            <dt class="text-base font-medium text-gray-900 dark:text-white">
                                {{ auth()->user()->profile?->primaryAddress->address_name ?? 'Belum ada alamat' }}
                            </dt>
                            <dd class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400">
                                @if (auth()->user()->profile?->primaryAddress)
                                    {{ auth()->user()->profile?->primaryAddress->receiver_name }} -
                                    {{ auth()->user()->profile?->primaryAddress->receiver_phone }},
                                    {{ $deliveryAddress }}
                                @endif
                            </dd>
                        </dl>

                        <a href="{{ route('account.addresses') }}"
                            class="text-base font-medium text-blue-700 hover:underline dark:text-blue-500">Edit</a>
                    </div>

                    <div class="mt-6">
                        <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                            <table class="w-full text-left font-medium text-gray-900 md:table-fixed dark:text-white">
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                                    @forelse ($cartItems as $item)
                                        @php
                                            $totalProductPrice = $item->quantity * $item->product->price;
                                            $totalPrice += $totalProductPrice;
                                        @endphp
                                        <tr>
                                            <td class="whitespace-nowrap py-4 md:w-[384px]">
                                                <div class="flex items-center gap-4">
                                                    <a href="{{ route('product.detail', $item->product->id) }}"
                                                        class="flex aspect-square h-10 w-10 shrink-0 items-center">

                                                        <img class="h-auto max-h-full w-full object-cover"
                                                            src="{{ asset('storage/' . $item->product->product_image_primary) }}"
                                                            alt="imac image" />

                                                    </a>
                                                    <a href="{{ route('product.detail', $item->product->id) }}"
                                                        class="text-wrap">
                                                        {{ $item->product->product_name }},
                                                        Rp. {{ number_format($item->product->price, 2, ',', '.') }}
                                                    </a>

                                                </div>
                                            </td>

                                            <td
                                                class="flex items-center gap-x-2 p-4 text-base font-normal text-gray-900 dark:text-white">
                                                <x-button.primary wire:click.prevent="qtyPlus({{ $item->id }})"
                                                    class="!px-2 !py-0.5">
                                                    <x-icons.plus class="h-4 w-4" />
                                                </x-button.primary>
                                                <span>x {{ $item->quantity }}</span>
                                                <x-button.primary class="!px-2 !py-0.5"
                                                    wire:click.prevent="qtyMinus({{ $item->id }})">
                                                    <x-icons.minus class="h-4 w-4" />
                                                </x-button.primary>
                                            </td>

                                            <td
                                                class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">
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
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <x-icons.bitcoin class="me-2 h-6 w-6 text-yellow-500" />

                                <span class="me-2">
                                    Gunakan {{ auth()->user()->profile->points }} poin untuk potongan?
                                </span>
                            </div>

                            <label class="inline-flex cursor-pointer items-center">
                                <input type="checkbox" value="" class="peer sr-only">
                                <div
                                    class="bg-neutral-quaternary peer-focus:ring-brand-soft dark:peer-focus:ring-brand-soft peer-checked:after:border-buffer peer-checked:bg-brand peer relative h-5 w-9 rounded-full after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:bg-white after:transition-all after:content-[''] peer-checked:after:translate-x-full peer-focus:outline-none peer-focus:ring-4 rtl:peer-checked:after:-translate-x-full">
                                </div>
                            </label>

                        </div>

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

                            <div class="gap-4 sm:flex sm:items-center">
                                <a href="{{ route('home') }}"
                                    class="w-full rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                    Kembali Belanja
                                </a>

                                <button type="submit"
                                    class="mt-4 flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:mt-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Proses
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </section>

        </div>
    </section>
</div>
