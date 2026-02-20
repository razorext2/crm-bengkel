<form wire:submit.prevent="make" class="grid h-fit grid-cols-2 gap-2 lg:gap-4">

    <div class="col-span-full">
        <flux:select label="Pilih data yang ingin diekspor" wire:model.live="laporan_type">
            <flux:select.option>
                Pilih data...
            </flux:select.option>
            @foreach ($models as $row)
                <flux:select.option value="{{ $row['model'] }}">
                    {{ $row['label'] }}
                </flux:select.option>
            @endforeach
        </flux:select>
    </div>

    @if ($laporan_type)
        @foreach ($status_choice['status'] as $row)
            <div class="col-span-full">
                <flux:select label="Pilih nilai dari field {{ $row['field'] }}"
                    wire:model.live="status.{{ $row['field'] }}">
                    <flux:select.option>
                        Pilih status...
                    </flux:select.option>
                    @foreach ($row['value'] as $val)
                        <flux:select.option value="{{ $val['value'] }}">
                            {{ $val['label'] }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            </div>
        @endforeach
    @endif

    <div class="col-span-2 flex justify-start">
        <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
            Buat Laporan
        </flux:button>
    </div>

</form>
