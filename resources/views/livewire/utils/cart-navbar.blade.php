<div>
    <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button"
        class="inline-flex items-center justify-center rounded-lg p-2 text-sm font-medium leading-none text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
        <span class="sr-only">
            Keranjang
        </span>
        <svg class="h-5 w-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
        </svg>
        <span class="hidden sm:flex">Keranjang</span>
        <svg class="ms-1 hidden h-4 w-4 text-gray-900 sm:flex dark:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 9-7 7-7-7" />
        </svg>
    </button>

    <div id="myCartDropdown1"
        class="z-10 mx-auto hidden max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">

        @forelse($cartItems as $item)
            <div class="grid grid-cols-2">
                <div>
                    <a href="#"
                        class="truncate text-sm font-semibold leading-none text-gray-900 hover:underline dark:text-white">
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
                <span class="w-full text-center"> Belum ada produk. </span>
            </div>
        @endforelse

        @if ($cartItems->count() > 0)
            <a href="#" title=""
                class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                role="button"> Proceed to Checkout </a>
        @endif

    </div>
</div>
