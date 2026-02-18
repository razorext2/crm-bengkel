<form wire:submit.prevent="store" class="flex h-fit flex-col gap-2 lg:gap-4">

    <div>
        <flux:input type="text" label="Nama Kategori" wire:model="catForm.name" />
    </div>

    <div>
        <flux:textarea wire:model="catForm.description" label="Deskripsi Kategori"
            placeholder="Deskripsikan kategori produk dalam beberapa kata..." />
    </div>

    <div>
        <div x-show="$wire.docForm.new_attachments.length > 0">
            <span class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Daftar Lampiran
            </span>

            <ul
                class="divide-y divide-gray-200 rounded-lg border border-gray-200 bg-white shadow-sm dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-700">

                @foreach ($docForm->new_attachments as $index => $row)
                    <li class="flex items-center gap-2 p-2 transition hover:bg-gray-50 dark:hover:bg-gray-800">
                        <div class="w-8 text-center text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ $index + 1 }}.
                        </div>

                        <div class="flex-1">
                            <p class="text-base font-medium text-gray-900 dark:text-gray-100">
                                {{ $row['nama_file'] }}
                            </p>
                        </div>

                        <button type="button" wire:click="removeAttachment({{ $index }})"
                            class="text-sm font-medium text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                            Hapus
                        </button>
                    </li>
                @endforeach

            </ul>

            @error('docForm.new_attachments.*')
                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full">
            <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="attachment">Ikon</label>

            <div class="flex w-full flex-col gap-y-2" x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <label for="attachment"
                    class="flex h-36 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 transition-all duration-500 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-800">
                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                        <x-icons.cloud-upload class="mb-2 h-8 w-8 text-gray-500 dark:text-gray-400" />

                        <p wire:loading.remove wire:target="docForm.attachment"
                            class="mb-0.5 text-sm text-gray-500 dark:text-white"> Klik untuk upload
                        </p>

                        <p class="mb-0.5 text-sm text-gray-500 dark:text-gray-400">
                            @if ($docForm->attachment)
                                <span class="font-semibold dark:text-white">
                                    {{ $docForm->attachment->getClientOriginalName() }}</span>
                            @endif
                        </p>

                        <div x-show="uploading"
                            class="mb-2 flex flex-col items-center gap-2 text-gray-800 dark:text-white">
                            <span wire:target="docForm.attachment" class="font-semibold">
                                Sedang Mengupload...</span>

                            <x-button.danger id="cancel-upload" type="button" class="text-xs"
                                wire:click="$cancelUpload('docForm.attachment')">
                                Cancel
                            </x-button.danger>
                        </div>

                        <p class="w-full text-center text-xs text-gray-500 dark:text-gray-400">
                            *Dokumentasi dapat berupa file Gambar (Min 10KB, Maks
                            2MB)
                        </p>
                    </div>
                    <input id="attachment" name="attachment" type="file" wire:model="docForm.attachment"
                        class="hidden" accept=".jpeg,.jpg,.bmp,.png,.heic" />
                </label>

                <div x-show="uploading" class="h-4 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                    <div class="h-4 rounded-full bg-blue-600" x-bind:style="{ width: progress + '%' }">
                    </div>
                </div>

            </div>

            @error('docForm.attachment')
                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-2 flex w-full justify-end lg:mt-4">
            <flux:button type="button" wire:click="storeLampiran" icon="plus" variant="primary" color="blue">
                Tambah Ikon
            </flux:button>
        </div>
    </div>

    <div class="flex justify-start">
        <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
            Simpan Kategori
        </flux:button>
    </div>
</form>
