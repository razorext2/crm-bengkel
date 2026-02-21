    <flux:table :paginate="$this->vouchers">
        <flux:table.columns>
            <flux:table.column>No. </flux:table.column>
            <flux:table.column>Aksi</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'code'" :direction="$sortDirection"
                wire:click="sort('code')">
                Kode Voucher
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'discount_type'" :direction="$sortDirection"
                wire:click="sort('discount_type')">
                Tipe Diskon
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'discount_value'" :direction="$sortDirection"
                wire:click="sort('discount_value')">
                Nilai Diskon
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'min_transaction'" :direction="$sortDirection"
                wire:click="sort('min_transaction')">
                Min. Transaksi
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'max_usage'" :direction="$sortDirection"
                wire:click="sort('max_usage')">
                Maks. Penggunaan
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'usage_per_user'" :direction="$sortDirection"
                wire:click="sort('usage_per_user')">
                Limit User
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'start_at'" :direction="$sortDirection"
                wire:click="sort('start_at')">
                Tanggal Mulai
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'end_at'" :direction="$sortDirection"
                wire:click="sort('end_at')">
                Tanggal Berakhir
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'is_active'" :direction="$sortDirection"
                wire:click="sort('is_active')">
                Status
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'new_user_only'" :direction="$sortDirection"
                wire:click="sort('new_user_only')">
                Khusus Pelanggan Baru?
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'min_user_transactions'" :direction="$sortDirection"
                wire:click="sort('min_user_transactions')">
                Minimal Transaksi User
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'max_user_transactions'" :direction="$sortDirection"
                wire:click="sort('max_user_transactions')">
                Maksimal Transaksi User
            </flux:table.column>
        </flux:table.columns>

        <flux:table.rows>

            @forelse($this->vouchers as $index => $row)
                <flux:table.row>
                    <flux:table.cell class="text-center">{{ $index + 1 }}</flux:table.cell>
                    <flux:table.cell class="flex gap-x-2">
                        <flux:button class="text-xs" color="blue" variant="primary" wire:navigate
                            href="{{ route('voucher.edit', $row->id) }}" icon="pencil" />

                        <flux:modal.trigger name="delete-voucher">
                            <flux:button color="red" variant="primary" icon="trash" />
                        </flux:modal.trigger>

                    </flux:table.cell>
                    <flux:table.cell variant="strong">{{ $row->code }}</flux:table.cell>
                    <flux:table.cell>{{ ucfirst($row->discount_type) }}</flux:table.cell>
                    <flux:table.cell>
                        {{ $row->discount_type === 'percentage' ? number_format($row->discount_value, 0) . '%' : 'Rp ' . number_format($row->discount_value, '2', ',', '.') }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ 'Rp ' . number_format($row->min_transaction, '2', ',', '.') }}
                    </flux:table.cell>
                    <flux:table.cell>{{ $row->max_usage }}x</flux:table.cell>
                    <flux:table.cell>{{ $row->usage_per_user }}x</flux:table.cell>
                    <flux:table.cell>{{ $row->start_at }}</flux:table.cell>
                    <flux:table.cell>{{ $row->end_at }}</flux:table.cell>
                    <flux:table.cell>
                        {{ $row->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $row->new_user_only ? 'Khusus Pelanggan Baru' : 'Semua Pelanggan' }}
                    </flux:table.cell>
                    <flux:table.cell>{{ $row->min_user_transactions }} Kali</flux:table.cell>
                    <flux:table.cell>{{ $row->max_user_transactions }} Kali</flux:table.cell>
                </flux:table.row>

                <flux:modal name="delete-voucher" class="min-w-[22rem]">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Hapus Voucher?</flux:heading>

                            <flux:text class="mt-2">
                                Anda akan menghapus data voucher ini.<br>
                                Aksi tersebut tidak dapat dibatalkan.
                            </flux:text>
                        </div>

                        <div class="flex gap-2">
                            <flux:spacer />

                            <flux:modal.close>
                                <flux:button variant="ghost">Batal</flux:button>
                            </flux:modal.close>

                            <flux:button type="submit" variant="danger" wire:click="delete({{ $row->id }})">
                                Hapus voucher
                            </flux:button>
                        </div>
                    </div>
                </flux:modal>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="9">
                        <div class="flex flex-col items-center gap-2 py-8">
                            <x-placeholder-pattern class="size-16 stroke-gray-900/20 dark:stroke-neutral-100/20" />
                            <p class="text-sm text-gray-500">Tidak ada voucher yang ditemukan.</p>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @endforelse

        </flux:table.rows>
    </flux:table>
