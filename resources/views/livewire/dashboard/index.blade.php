<div class="flex flex-col gap-6">

    @php
        $revenue = $this->revenueData;
        $order = $this->orderData;
        $customer = $this->customerData;
    @endphp

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-semibold tracking-tight">Dashboard</h1>
        <p class="text-sm text-gray-500">
            Welcome back 👋 Here's what's happening today.
        </p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid gap-6 md:grid-cols-3">

        <flux:card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pendapatan</p>
                    <h2 class="text-2xl font-bold">
                        Rp {{ number_format($this->getTotalRevenue(), 2, ',', '.') }}
                    </h2>
                    <p class="{{ $revenue['percentage'] >= 0 ? 'text-green-500' : 'text-red-500' }} mt-1 text-xs">

                        {{ $revenue['percentage'] >= 0 ? '+' : '' }}
                        {{ $revenue['percentage'] }}% dibanding bulan lalu.
                    </p>
                </div>
                <div class="rounded-lg bg-green-100 p-3">
                    <flux:icon.banknotes class="h-6 w-6 text-green-600" />
                </div>
            </div>
        </flux:card>

        <flux:card>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pesanan</p>
                    <h2 class="text-2xl font-bold">{{ $this->getTotalOrder() }}</h2>
                    <p class="{{ $order['percentage'] >= 0 ? 'text-green-500' : 'text-red-500' }} mt-1 text-xs">

                        {{ $order['percentage'] >= 0 ? '+' : '' }}
                        {{ $order['percentage'] }}% dibanding bulan lalu.
                    </p>
                </div>
                <div class="rounded-lg bg-blue-100 p-3">
                    <flux:icon.shopping-bag class="h-6 w-6 text-blue-600" />
                </div>
            </div>
        </flux:card>

        <flux:card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pelanggan</p>
                    <h2 class="text-2xl font-bold">{{ $this->getTotalCustomer() }}</h2>
                    <p class="{{ $order['percentage'] >= 0 ? 'text-green-500' : 'text-red-500' }} mt-1 text-xs">

                        {{ $order['percentage'] >= 0 ? '+' : '' }}
                        {{ $order['percentage'] }}% dibanding bulan lalu.
                    </p>
                </div>
                <div class="rounded-lg bg-purple-100 p-3">
                    <flux:icon.users class="h-6 w-6 text-purple-600" />
                </div>
            </div>
        </flux:card>

    </div>

    {{-- Main Section --}}
    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Statistics Card --}}
        <div class="lg:col-span-2">
            <flux:card>
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-semibold">Sales Overview</h3>
                    <flux:button size="sm" variant="ghost">
                        This Month
                    </flux:button>
                </div>

                <div class="flex h-64 items-center justify-center text-gray-400">
                    Chart Placeholder
                </div>
            </flux:card>
        </div>

        {{-- Recent Orders --}}
        <div>
            <flux:card>
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="font-semibold">Transaksi Terakhir</h3>
                    <flux:button size="sm" href="{{ route('transaction.index') }}" variant="ghost">
                        Semua
                    </flux:button>
                </div>

                <div class="space-y-4">
                    @forelse($this->fiveLastOrders() as $row)
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-medium">#{{ $row->invoice_number }}</p>
                                <p class="text-xs text-gray-500">{{ $row->user->name }}</p>
                            </div>

                            @php
                                $statusColors = [
                                    0 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                    1 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                    2 => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                    3 => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                    4 => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                ];
                            @endphp

                            <dd
                                class="{{ $statusColors[$row->order_status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }} me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium">
                                {{ $row->order_status_description['description'] }}
                            </dd>
                        </div>
                    @empty
                        <p>Belum ada pesanan baru.</p>
                    @endforelse
                </div>
            </flux:card>
        </div>

    </div>

</div>
