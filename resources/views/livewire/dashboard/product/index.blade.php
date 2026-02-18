<flux:table :paginate="$this->products">
    <flux:table.columns>
        <flux:table.column>No. </flux:table.column>
        <flux:table.column>Foto</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'product_name'" :direction="$sortDirection"
            wire:click="sort('product_name')">
            Nama Produk
        </flux:table.column>
        <flux:table.column sortable :soretd="$sortBy === 'category_id'" :direction="$sortDirection"
            wire:click="sort('category_id')">
            Kategori
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'product_unit'" :direction="$sortDirection"
            wire:click="sort('product_unit')">
            Satuan
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'product_weight'" :direction="$sortDirection"
            wire:click="sort('product_weight')">
            Berat
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'price'" :direction="$sortDirection"
            wire:click="sort('price')">
            Harga Per Satuan
        </flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'stock'" :direction="$sortDirection"
            wire:click="sort('stock')">
            Stok
        </flux:table.column>
        <flux:table.column>Aksi</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>

        @forelse($this->products as $index => $row)
            <flux:table.row>
                <flux:table.cell class="text-center">{{ $index + 1 }}</flux:table.cell>
                <flux:table.cell>
                    <flux:avatar size="md" src="{{ asset('storage/' . $row->product_image_primary) }}" />
                </flux:table.cell>
                <flux:table.cell>{{ $row->product_name }}</flux:table.cell>
                <flux:table.cell>{{ $row->category->category_name }}</flux:table.cell>
                <flux:table.cell>{{ $row->product_unit }}</flux:table.cell>
                <flux:table.cell variant="strong">{{ $row->product_weight }} </flux:table.cell>
                <flux:table.cell variant="strong">Rp. {{ number_format($row->price, '2', ',', '.') }} </flux:table.cell>
                <flux:table.cell variant="strong">{{ $row->stock }} </flux:table.cell>
                <flux:table.cell class="flex gap-x-2">
                    <flux:button class="text-xs" color="blue" variant="primary" wire:navigate
                        href="{{ route('category.edit', $row->id) }}" icon="pencil" />

                    <flux:button color="red"
                        wire:confirm.prompt="Yakin ingin menghapus?\nKetik YA jika anda yakin|YA" variant="primary"
                        wire:click="delete({{ $row->id }})" icon="trash" />
                </flux:table.cell>
            </flux:table.row>
        @empty
            <flux:table.row>
                <flux:table.cell colspan="9">
                    <div class="flex flex-col items-center gap-2 py-8">
                        <x-placeholder-pattern class="size-16 stroke-gray-900/20 dark:stroke-neutral-100/20" />
                        <p class="text-sm text-gray-500">Tidak ada kategori produk yang ditemukan.</p>
                    </div>
                </flux:table.cell>
            </flux:table.row>
        @endforelse

    </flux:table.rows>
</flux:table>
