<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="w-full">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('report.index') }}" separator="slash">Laporan
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <flux:heading size="xl">Buat Laporan</flux:heading>

        <p class="text-sm text-gray-800 dark:text-white">
            Anda dapat membuat laporan di halaman ini. Silahkan pilih data yang mau anda export:
        </p>

        <div
            class="relative max-w-lg flex-1 overflow-hidden rounded-xl border border-neutral-200 p-2 lg:p-4 dark:border-neutral-700">

            @livewire('dashboard.report.index')

        </div>
    </div>
</x-layouts::app>
