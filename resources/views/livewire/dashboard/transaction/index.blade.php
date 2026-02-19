<flux:table :paginate="$this->transactions">
    <flux:table.columns>
        <flux:table.column>No. </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'invoice_number'" :direction="$sortDirection"
            wire:click="sort('invoice_number')">
            Nomor Invoice
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'user_id'" :direction="$sortDirection"
            wire:click="sort('user_id')">
            Nama Customer
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'order_status'" :direction="$sortDirection"
            wire:click="sort('order_status')">
            Status Transaksi
        </flux:table.column>
        <flux:table.column>
            Jasa Pengiriman dan Biaya
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'total_amount'" :direction="$sortDirection"
            wire:click="sort('total_amount')">
            Total Bayar
        </flux:table.column>
        <flux:table.column>Aksi</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>

        @forelse($this->transactions as $index => $row)
            <flux:table.row>
                <flux:table.cell class="text-center">
                    {{ $index + 1 }}
                </flux:table.cell>
                <flux:table.cell variant="strong">
                    {{ $row->invoice_number }}
                </flux:table.cell>
                <flux:table.cell>
                    {{ $row->user->name }}
                </flux:table.cell>
                <flux:table.cell class="flex flex-col gap-1">
                    <span
                        class="{{ $this->setStatus($row->order_status) }} me-2 inline-flex w-fit items-center rounded px-2.5 py-0.5 text-xs font-medium">
                        {{ $row->order_status_description['description'] }}
                    </span>
                    @if ($row->order_status == 0 && $row->payment_proof)
                        <span
                            class="me-2 inline-flex w-fit items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                            Menunggu Verifikasi
                        </span>
                    @endif
                    @if ($row->is_completed)
                        <span
                            class="inline-flex w-fit items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                            Pesanan Selesai
                        </span>
                    @endif
                </flux:table.cell>
                <flux:table.cell variant="strong">
                    {{ $row->shipping_service ?? 'Belum dipilih' }} (Rp.
                    {{ number_format($row->shipping_cost, '2', ',', '.') }})
                </flux:table.cell>
                <flux:table.cell variant="strong">
                    Rp. {{ number_format($row->total_amount, '2', ',', '.') }}
                </flux:table.cell>
                <flux:table.cell class="flex gap-x-2">
                    <flux:button class="text-xs" color="blue" variant="primary" wire:navigate
                        href="{{ route('transaction.view', $row->id) }}" icon="eye" />
                </flux:table.cell>
            </flux:table.row>
        @empty
            <flux:table.row>
                <flux:table.cell colspan="7">
                    <div class="flex flex-col items-center gap-2 py-8">
                        <x-placeholder-pattern class="size-16 stroke-gray-900/20 dark:stroke-neutral-100/20" />
                        <p class="text-sm text-gray-500">Belum ada transaksi baru.</p>
                    </div>
                </flux:table.cell>
            </flux:table.row>
        @endforelse

    </flux:table.rows>
</flux:table>
