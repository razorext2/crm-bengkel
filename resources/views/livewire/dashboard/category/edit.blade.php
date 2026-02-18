<form wire:submit.prevent="store" class="flex h-fit flex-col gap-2 lg:gap-4">

    <div>
        <flux:input type="text" label="Nama Kategori" wire:model="catForm.name" />
    </div>

    <div>
        <flux:textarea wire:model="catForm.description" label="Deskripsi Kategori"
            placeholder="Deskripsikan kategori produk dalam beberapa kata..." />
    </div>

    <div class="flex justify-start">
        <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
            Simpan Kategori
        </flux:button>
    </div>
</form>
