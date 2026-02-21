<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky collapsible="mobile"
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav class="hidden md:block">
            <flux:sidebar.item class="px-2 py-0.5">
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
                }" x-init="init">

                    <div x-text="date" class="text-sm text-gray-500"></div>
                    <div x-text="time" class="text-base font-bold"></div>

                </div>
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Fitur')" class="grid">
                <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    Dashboard
                </flux:sidebar.item>

                <flux:sidebar.item icon="clipboard-document-list" :href="route('category.index')"
                    :current="request()->routeIs('category.*')" wire:navigate>
                    Kategori
                </flux:sidebar.item>

                <flux:sidebar.item icon="building-storefront" :href="route('product.index')"
                    :current="request()->routeIs('product.*')" wire:navigate>
                    Produk
                </flux:sidebar.item>

                <flux:sidebar.item icon="users" :href="route('customer.index')"
                    :current="request()->routeIs('customer.*')" wire:navigate>
                    Data Pelanggan
                </flux:sidebar.item>

                <flux:sidebar.item icon="currency-dollar" :href="route('transaction.index')"
                    :current="request()->routeIs('transaction.*')" wire:navigate>
                    Transaksi
                </flux:sidebar.item>

                <flux:sidebar.item icon="truck" :href="route('delivery.index')"
                    :current="request()->routeIs('delivery.*')" wire:navigate>
                    Pengiriman
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="document-duplicate" href="{{ route('report.index') }}" wire:navigate
                :current="request()->routeIs('report.*')">
                Laporan
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
