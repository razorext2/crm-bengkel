<flux:table :paginate="$this->categories">
    <flux:table.columns>
        <flux:table.column>No. </flux:table.column>
        <flux:table.column>Ikon</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'category_name'" :direction="$sortDirection"
            wire:click="sort('category_name')">Nama Kategori</flux:table.column>
        <flux:table.column>Deskripsi</flux:table.column>
        <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection"
            wire:click="sort('created_at')">Dibuat Tanggal</flux:table.column>
        <flux:table.column>Total Produk</flux:table.column>
        <flux:table.column>Aksi</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>

        @forelse($this->categories as $index => $category)
            <flux:table.row>
                <flux:table.cell class="text-center">{{ $index + 1 }}</flux:table.cell>
                <flux:table.cell>
                    <flux:avatar size="md" src="{{ asset('storage/' . $category->category_icon) }}" />
                </flux:table.cell>
                <flux:table.cell>{{ $category->category_name }}</flux:table.cell>
                <flux:table.cell>{{ $category->category_description }}</flux:table.cell>
                <flux:table.cell>{{ $category->created_at->format('M d, h:i A') }}</flux:table.cell>
                <flux:table.cell variant="strong">
                    {{ $category->products_count }} Produk
                </flux:table.cell>
                <flux:table.cell class="flex gap-x-2">
                    <flux:button class="text-xs" color="blue" variant="primary" wire:navigate
                        href="{{ route('category.edit', $category->id) }}" icon="pencil" />

                    <flux:button color="red"
                        wire:confirm.prompt="Yakin ingin menghapus?\nKetik YA jika anda yakin|YA" variant="primary"
                        wire:click="delete({{ $category->id }})" icon="trash" />
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
