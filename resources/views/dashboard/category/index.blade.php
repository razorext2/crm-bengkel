<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="w-full">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('category.index') }}" separator="slash">Kategori
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <flux:heading size="xl">Daftar Kategori Produk</flux:heading>

        <p class="text-sm text-gray-800 dark:text-white">
            Berikut adalah daftar kategori produk yang tersedia. Anda dapat menambahkan, mengedit, atau menghapus
            kategori sesuai kebutuhan bisnis Anda.
        </p>

        <div class="flex items-center justify-start">
            <flux:button href="{{ route('category.create') }}" wire:navigate icon="plus" variant="primary"
                color="green">
                Tambah Kategori
            </flux:button>
        </div>

        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 p-2 lg:p-4 dark:border-neutral-700">



            @livewire('dashboard.category.index')

        </div>
    </div>
</x-layouts::app>
