<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="w-full">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('promo.index') }}" separator="slash">
                    Promo
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <flux:heading size="xl">Daftar Promo</flux:heading>

        <p class="text-sm text-gray-800 dark:text-white">
            Berikut adalah daftar promo yang tersedia. Anda dapat menambahkan, mengedit, atau menghapus sesuai kebutuhan
            bisnis Anda.
        </p>

        <div class="flex items-center justify-start">
            <flux:button href="{{ route('promo.create') }}" wire:navigate icon="plus" variant="primary"
                color="green">
                Tambah Promo
            </flux:button>
        </div>

        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 p-2 lg:p-4 dark:border-neutral-700">

            {{-- @livewire('dashboard.promo.index') --}}

        </div>
    </div>
</x-layouts::app>
