<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="w-full">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('customer.index') }}" separator="slash">Pelanggan
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <flux:heading size="xl">Detail Pelanggan</flux:heading>

        <p class="text-sm text-gray-800 dark:text-white">
            Berikut adalah informasi lengkap mengenai pelanggan Anda.
        </p>

        <div class="flex items-center justify-start">
            <flux:button href="{{ route('customer.index') }}" wire:navigate icon="chevron-left" variant="primary"
                color="red">
                Kembali
            </flux:button>
        </div>

        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 p-2 lg:p-4 dark:border-neutral-700">

            @livewire('dashboard.customer.view', ['id' => $id])

        </div>
    </div>
</x-layouts::app>
