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
                        <a href="{{ route('home') }}" wire:navigate title=""
                            class="{{ request()->routeIs('home') ? 'text-blue-700' : 'text-gray-900' }} flex text-sm font-medium text-gray-900 hover:text-blue-700">
                            Beranda
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="{{ route('products', ['category' => 0]) }}" wire:navigate title=""
                            class="{{ request()->routeIs('products') ? 'text-blue-700' : 'text-gray-900' }} flex text-sm font-medium hover:text-blue-700">
                            Semua Produk
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="{{ route('best-seller') }}" wire:navigate title=""
                            class="{{ request()->routeIs('best-seller') ? 'text-blue-700' : 'text-gray-900' }} flex text-sm font-medium hover:text-blue-700">
                            Paling Laku
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="{{ route('today-promo') }}" wire:navigate title=""
                            class="{{ request()->routeIs(patterns: 'today-promo') ? 'text-blue-700' : 'text-gray-900' }} text-sm font-medium text-gray-900 hover:text-blue-700">
                            Promo Hari Ini
                        </a>
                    </li>

                </ul>
            </div>



            <div class="flex items-center lg:space-x-2">

                <div x-data="{
                    time: '',
                    date: '',
                    init() {
                        setInterval(() => {
                            const now = new Date();
                            this.time = now.toLocaleTimeString('id-ID');
                            this.date = now.toLocaleDateString('id-ID', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                        }, 1000);
                    }
                }" x-init="init" class="me-4 hidden text-right md:block">

                    <div x-text="date" class="text-sm text-gray-500"></div>
                    <div x-text="time" class="text-base font-bold"></div>

                </div>

                @auth
                    <p data-popover-target="popover-point-hint" class="me-2 text-sm font-medium text-yellow-500 lg:me-4">
                        Poin: {{ auth()->user()->profile->points }}
                    </p>

                    <div data-popover id="popover-point-hint" role="tooltip"
                        class="text-body border-default rounded-base shadow-xs invisible absolute z-10 inline-block w-64 border bg-blue-200 text-sm opacity-0 transition-opacity duration-300">
                        <div class="px-3 py-2">
                            1 Poin = 1 Rupiah. Anda dapat menukarnya saat melakukan transaksi.
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    @livewire('utils.cart-navbar')

                    <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                        class="inline-flex items-center justify-center rounded-lg p-2 text-sm font-medium leading-none text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <svg class="me-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="hidden sm:block"> Profil Saya </span>
                        <svg class="ms-1 h-4 w-4 text-gray-900 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="userDropdown1"
                        class="z-10 hidden w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">

                        <div class="w-full cursor-default bg-red-200 px-5 py-2">
                            <span class="text-lg font-semibold">{{ auth()->user()->name }}</span>
                            <span class="text-sm">{{ auth()->user()->email }}</span>
                        </div>

                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            {{-- <li>
                                <a href="{{ route('account.me') }}" title=""
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Akun Saya
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('account.order') }}" title=""
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Pesanan Saya
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('account.review') }}" title=""
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Ulasan Saya
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('account.favorite') }}" title=""
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Favorit
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('account.addresses') }}" title=""
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Alamat Pengiriman
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('account.settings') }}" title=""
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Pengaturan
                                </a>
                            </li>
                        </ul>

                        <div class="t p-2 text-sm font-medium text-red-500 dark:text-white">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-red-100 dark:hover:bg-red-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1"
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
                    </button> --}}
                @else
                    <div id="myCartDropdownButton1" class="text-right text-xs md:text-sm">
                        <p class="text-gray-800">Anda melihat sebagai <span class="font-bold">Guest</span></p>
                        <p class="text-gray-800">Silahkan <a href="{{ route('register') }}"
                                class="font-bold text-green-500">Daftar</a> atau
                            <a href="{{ route('login') }}" class="font-bold text-green-500">Login </a>
                        </p>
                    </div>
                @endauth
            </div>
        </div>

        {{-- <div id="ecommerce-navbar-menu-1"
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
        </div> --}}
    </div>
</nav>
