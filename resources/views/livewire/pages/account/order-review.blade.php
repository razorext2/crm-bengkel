<div class="mx-auto min-h-max w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Review Saya'])

    <section
        class="rounded-lg border border-gray-200 bg-white p-2 antialiased shadow-md md:py-16 lg:p-4 dark:bg-gray-900">

        <h2 class="mb-4 flex items-center gap-x-2 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Beri Ulasan #{{ $data->invoice_number }}
        </h2>

        <div>
            @foreach ($data->transactionDetail as $item)
                <section
                    class="border-default rounded-base shadow-xs flex w-full flex-col items-center border p-6 md:flex-row">

                    <img class="rounded-base mb-4 h-64 w-full object-cover md:mb-0 md:h-auto md:w-48"
                        src="{{ asset('storage/' . $item->product->product_image_primary) }}" alt="">

                    <div class="flex w-full flex-col leading-normal md:p-4">
                        <h5 class="text-heading mb-2 text-2xl font-bold tracking-tight">
                            {{ $item->product->product_name }}
                        </h5>

                        <hr class="mb-4" />

                        <div class="flex flex-col gap-2">
                            <div>
                                <label for="rating"
                                    class="text-heading mb-2.5 block text-sm font-medium">Rating</label>

                                <div class="flex items-center space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button"
                                            wire:click="$set('ratings.{{ $item->id }}', {{ $i }})"
                                            class="focus:outline-none">
                                            <x-icons.star
                                                class="{{ ($ratings[$item->id] ?? 0) >= $i ? 'text-yellow-400' : 'text-gray-400' }} h-7 w-7 transition-colors duration-200" />
                                        </button>
                                    @endfor

                                </div>

                            </div>

                            <x-input.text-area id="review" label="Ulasan" placeholder="Ketik penilaian anda..."
                                rows="4" errorName="review" wire:model="reviews.{{ $item->id }}" />
                        </div>

                        <hr />
                    </div>
                </section>
            @endforeach

            <div class="mt-2 flex w-full justify-end lg:mt-4">
                <x-button.primary wire:click="store" type="button" id="store-review">
                    Simpan Ulasan
                </x-button.primary>
            </div>
        </div>

    </section>

</div>
