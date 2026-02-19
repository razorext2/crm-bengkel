<flux:table :paginate="$this->customers">
    <flux:table.columns>
        <flux:table.column>No. </flux:table.column>
        <flux:table.column>Foto</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'product_name'" :direction="$sortDirection"
            wire:click="sort('product_name')">
            Nama Customer
        </flux:table.column>
        <flux:table.column sortable :soretd="$sortBy === 'category_id'" :direction="$sortDirection"
            wire:click="sort('category_id')">
            Email
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'product_unit'" :direction="$sortDirection"
            wire:click="sort('product_unit')">
            Telepon
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'product_weight'" :direction="$sortDirection"
            wire:click="sort('product_weight')">
            Alamat
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'product_weight'" :direction="$sortDirection"
            wire:click="sort('product_weight')">
            Poin
        </flux:table.column>
        <flux:table.column>Aksi</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>

        @forelse($this->customers as $index => $row)
            <flux:table.row>
                <flux:table.cell class="text-center">{{ $index + 1 }}</flux:table.cell>
                <flux:table.cell>
                    <flux:avatar size="md" src="{{ asset('storage/' . $row->profile->profile_photo) }}" />
                </flux:table.cell>
                <flux:table.cell>{{ $row->name }}</flux:table.cell>
                <flux:table.cell>{{ $row->email }}</flux:table.cell>
                <flux:table.cell>{{ $row->profile->phone_number }}</flux:table.cell>
                <flux:table.cell variant="strong">
                    {{ $row->profile->primaryAddress->address_detail }}
                </flux:table.cell>
                <flux:table.cell>{{ $row->profile->points }}</flux:table.cell>
                <flux:table.cell class="flex gap-x-2">
                    <flux:button class="text-xs" color="blue" variant="primary" wire:navigate
                        href="{{ route('customer.view', $row->id) }}" icon="eye" />
                </flux:table.cell>
            </flux:table.row>
        @empty
            <flux:table.row>
                <flux:table.cell colspan="7">
                    <div class="flex flex-col items-center gap-2 py-8">
                        <x-placeholder-pattern class="size-16 stroke-gray-900/20 dark:stroke-neutral-100/20" />
                        <p class="text-sm text-gray-500">Tidak ada kategori produk yang ditemukan.</p>
                    </div>
                </flux:table.cell>
            </flux:table.row>
        @endforelse

    </flux:table.rows>
</flux:table>
