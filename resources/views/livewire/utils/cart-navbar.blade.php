<div class="relative" wire:click.outside="$set('showCart', false)">
    <button wire:click="$toggle('showCart')" type="button"
        class="inline-flex cursor-pointer items-center justify-center rounded-lg p-2 text-sm font-medium leading-none text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
        <x-icons.cart class="h-5 w-5 lg:me-1" />
        <span class="hidden sm:flex">Keranjang</span>
        <x-icons.arrow-down class="ms-1 hidden h-4 w-4 text-gray-900 sm:flex dark:text-white" />
    </button>

    <div wire:show="showCart"
        class="absolute -right-16 top-12 z-50 w-96 space-y-4 overflow-hidden rounded-lg bg-white p-4 shadow-lg lg:right-0 dark:bg-gray-800">

        @forelse($carts as $item)
            <div class="grid grid-cols-2">
                <div>
                    <a href="#"
                        class="truncate text-wrap text-sm font-semibold leading-none text-gray-900 hover:underline dark:text-white">
                        {{ $item->product->product_name }}
                    </a>
                    <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                        Rp. {{ number_format($item->product->price, 2, ',', '.') }}
                    </p>
                </div>

                <div class="flex items-center justify-end gap-6">
                    <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty:
                        {{ $item->quantity }}</p>

                    <button data-tooltip-target="tooltipRemoveItem2a" wire:click="removeItem({{ $item->id }})"
                        type="button"
                        class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                        <span class="sr-only"> Remove </span>

                        <x-icons.close class="h-4 w-4" />
                    </button>

                    <div id="tooltipRemoveItem2a" role="tooltip"
                        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                        Remove item
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>
        @empty
            <div class="grid grid-cols-2">
                <span class="w-full text-center"> Belum ada produk . </span>
            </div>
        @endforelse

        @if ($carts->count() > 0)
            <a href="{{ route('checkout.index') }}" title=""
                class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                role="button"> Proses Checkout </a>
        @endif

    </div>
</div>
