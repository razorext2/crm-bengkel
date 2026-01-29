<nav class="bg-white antialiased dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl px-4 py-4 2xl:px-0">
        <div class="flex items-center justify-between">

            <div class="flex items-center space-x-8">
                <div class="shrink-0">
                    {{-- <a href="#" title="" class="">
                        <img class="block h-8 w-auto dark:hidden"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full.svg" alt="">
                        <img class="hidden h-8 w-auto dark:block"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full-dark.svg" alt="">
                    </a> --}}
                    <h1 class="text-2xl font-extrabold text-red-700"> MolJaya<span class="font-semibold italic">Motor
                        </span>
                    </h1>
                </div>

                <ul class="hidden items-center justify-start gap-6 py-3 sm:justify-center md:gap-8 lg:flex">
                    <li>
                        <a href="{{ route('home') }}" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-blue-700 dark:text-white dark:hover:text-blue-500">
                            Beranda
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-blue-700 dark:text-white dark:hover:text-blue-500">
                            Paling Laku
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-blue-700 dark:text-white dark:hover:text-blue-500">
                            Sparepart Motor & Mobil
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="#" title=""
                            class="text-sm font-medium text-gray-900 hover:text-blue-700 dark:text-white dark:hover:text-blue-500">
                            Promo Hari Ini
                        </a>
                    </li>

                </ul>
            </div>

            <div class="flex items-center lg:space-x-2">

                <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-sm font-medium leading-none text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <span class="sr-only">
                        Keranjang
                    </span>
                    <svg class="h-5 w-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                    <span class="hidden sm:flex">Keranjang</span>
                    <svg class="ms-1 hidden h-4 w-4 text-gray-900 sm:flex dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div id="myCartDropdown1"
                    class="z-10 mx-auto hidden max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">

                    <div class="grid grid-cols-2">
                        <span class="w-full text-center"> Belum ada produk. </span>
                    </div>

                    {{--
                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="truncate text-sm font-semibold leading-none text-gray-900 hover:underline dark:text-white">Apple
                                iPad Air</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$499</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>

                            <button data-tooltip-target="tooltipRemoveItem2a" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem2a" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="truncate text-sm font-semibold leading-none text-gray-900 hover:underline dark:text-white">Apple
                                Watch SE</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$598</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 2</p>

                            <button data-tooltip-target="tooltipRemoveItem3b" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem3b" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="truncate text-sm font-semibold leading-none text-gray-900 hover:underline dark:text-white">Sony
                                Playstation 5</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$799</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 1</p>

                            <button data-tooltip-target="tooltipRemoveItem4b" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem4b" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div>
                            <a href="#"
                                class="truncate text-sm font-semibold leading-none text-gray-900 hover:underline dark:text-white">Apple
                                iMac 20"</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$8,997</p>
                        </div>

                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qty: 3</p>

                            <button data-tooltip-target="tooltipRemoveItem5b" type="button"
                                class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                <span class="sr-only"> Remove </span>
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="tooltipRemoveItem5b" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>

                    <a href="#" title=""
                        class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        role="button"> Proceed to Checkout </a> --}}

                </div>

                <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-sm font-medium leading-none text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <svg class="me-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Profil Saya
                    <svg class="ms-1 h-4 w-4 text-gray-900 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div id="userDropdown1"
                    class="z-10 hidden w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                    <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                        <li>
                            <a href="{{ route('account.my') }}" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Akun Saya
                            </a>
                        </li>
                        <li><a href="#" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Pesanan Saya
                            </a>
                        </li>
                        <li><a href="#" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Pengaturan </a></li>
                        <li><a href="#" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Disimpan </a></li>
                        <li><a href="#" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Alamat Pengiriman </a></li>
                    </ul>

                    <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                        <a href="#" title=""
                            class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                            Logout </a>
                    </div>
                </div>

                <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1"
                    aria-controls="ecommerce-navbar-menu-1" aria-expanded="false"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-900 hover:bg-gray-100 lg:hidden dark:text-white dark:hover:bg-gray-700">
                    <span class="sr-only">
                        Open Menu
                    </span>
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="ecommerce-navbar-menu-1"
            class="mt-4 hidden rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-600 dark:bg-gray-700">
            <ul class="space-y-3 text-sm font-medium text-gray-900 dark:text-white dark:text-white">
                <li>
                    <a href="#" class="hover:text-blue-700 dark:hover:text-blue-500">Home</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-700 dark:hover:text-blue-500">Best Sellers</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-700 dark:hover:text-blue-500">Gift Ideas</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-700 dark:hover:text-blue-500">Games</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-700 dark:hover:text-blue-500">Electronics</a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-700 dark:hover:text-blue-500">Home & Garden</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
