<form wire:submit.prevent="store" class="grid h-fit grid-cols-2 gap-2 lg:gap-4">

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="text" placeholder="Buat kode voucher..." label="Kode Voucher" wire:model="voucherForm.code" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:select label="Pilih Kategori" wire:model="voucherForm.discount_type">
            <flux:select.option>
                Pilih tipe potongan...
            </flux:select.option>
            <flux:select.option value="percentage">
                Persenan
            </flux:select.option>
            <flux:select.option value="fixed">
                Tetap
            </flux:select.option>
        </flux:select>
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="number" min="1" placeholder="Besaran potongan... ex: 10% atau 10000" label="Potongan"
            wire:model="voucherForm.discount_value" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="number" min="1" placeholder="Berapa total transaksi agar voucher dapat digunakan..."
            label="Min. Total Bayar" wire:model="voucherForm.min_transaction" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="number" min="1" placeholder="Berapa kali voucher dapat digunakan..."
            label="Kuota Voucher (Seluruh Customer)" wire:model="voucherForm.max_usage" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="number" min="1" placeholder="Limit penggunaan per customer..."
            label="Limit Penggunaan (Per Customer)" wire:model="voucherForm.usage_per_user" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="number" min="0" placeholder="Bisa digunakan oleh customer dengan minimal transaksi..."
            label="Min. Transaksi Customer" wire:model="voucherForm.min_user_transactions" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="number" min="1" placeholder="Limit penggunaan per customer..."
            label="Max. Transaksi Customer" wire:model="voucherForm.max_user_transactions" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="datetime-local" placeholder="Waktu voucher bisa digunakan..." label="Dimulai Dari"
            wire:model="voucherForm.start_at" />
    </div>

    <div class="col-span-2 lg:col-span-1">
        <flux:input type="datetime-local" placeholder="Waktu voucher kadaluarsa..." label="Berakhir Pada"
            wire:model="voucherForm.end_at" />
    </div>

    <div class="col-span-full space-y-2">
        <flux:checkbox label="Untuk user baru saja?" wire:model="voucherForm.new_user_only" />
        <flux:checkbox label="Aktif?" wire:model="voucherForm.is_active" />
    </div>

    <div class="col-span-2 flex justify-start">
        <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
            Simpan Voucher
        </flux:button>
    </div>
</form>
