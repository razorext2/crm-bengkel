<div class="mx-auto mb-20 p-4 md:max-w-5xl lg:max-w-7xl lg:p-8 2xl:max-w-screen-2xl">
    @php
        $label = $category_id == 0 ? 'Semua Produk' : $this->getCategoryById()->category_name;
    @endphp

    @livewire('utils.breadcumb', ['page' => 'Produk', 'subpage' => $label])

    <h2 class="mb-4 text-lg font-semibold md:text-xl lg:mb-8 lg:text-2xl">
        {{ $label }}
    </h2>

    <div class="flex w-full flex-col gap-4 lg:flex-row lg:gap-8">

        <div id="filter-open" data-accordion="open"
            class="border-default h-fit max-w-full flex-none overflow-hidden rounded-lg border bg-white p-2 antialiased shadow-lg lg:min-w-72 lg:max-w-72 lg:p-4 dark:bg-gray-900">

            {{-- filter by kategori --}}
            <h2 id="filter-open-heading-1">
                <button type="button"
                    class="text-body rounded-t-base border-b-default hover:text-heading flex w-full items-center justify-between gap-3 border border-x-0 border-t-0 p-2 font-medium rtl:text-right"
                    data-accordion-target="#filter-open-body-1" aria-expanded="{{ $aria_expanded }}"
                    aria-controls="filter-open-body-1">
                    Kategori
                    <x-icons.chevron-down data-accordion-icon class="h-5 w-5 shrink-0 rotate-180" />
                </button>
            </h2>
            <div id="filter-open-body-1"
                class="border-b-default {{ $aria_expanded ? '' : 'hidden' }} border border-e-0 border-s-0 border-t-0"
                aria-labelledby="filter-open-heading-1">
                <fieldset class="p-2">
                    <legend class="sr-only">Checkbox kategori</legend>
                    @forelse($this->getCategories() as $row)
                        <div class="mb-4 flex items-center">
                            <input id="checkbox-category-{{ $row->id }}"
                                wire:model.live="categories.{{ $row->id }}" type="checkbox"
                                class="border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-brand-soft h-4 w-4 border focus:ring-2">
                            <label for="checkbox-category-{{ $row->id }}"
                                class="text-heading ms-2 select-none text-sm font-medium">
                                {{ $row->category_name }}
                            </label>
                        </div>
                    @empty
                        <p class="text-sm">Belum ada kategori produk.</p>
                    @endforelse

                </fieldset>
            </div>
            {{-- end filter by kategori --}}

            {{-- filter by price range --}}
            <h2 id="filter-open-heading-2">
                <button type="button"
                    class="text-body rounded-t-base border-b-default hover:text-heading flex w-full items-center justify-between gap-3 border border-x-0 border-t-0 p-2 font-medium rtl:text-right"
                    data-accordion-target="#filter-open-body-2" aria-expanded="{{ $aria_expanded }}"
                    aria-controls="filter-open-body-2">
                    Harga
                    <x-icons.chevron-down data-accordion-icon class="h-5 w-5 shrink-0 rotate-180" />
                </button>
            </h2>
            <div id="filter-open-body-2"
                class="border-b-default {{ $aria_expanded ? '' : 'hidden' }} border border-e-0 border-s-0 border-t-0"
                aria-labelledby="filter-open-heading-2">
                <fieldset class="p-2">
                    @php
                        $priceOptions = [
                            'under_99' => 'Dibawah 99rb',
                            '100_249' => '100rb - 249rb',
                            '250_499' => '250rb - 499rb',
                            '500_999' => '500rb - 999rb',
                            'above_1jt' => 'Diatas 1jt',
                        ];
                    @endphp

                    <legend class="sr-only">Checkbox harga</legend>
                    @foreach ($priceOptions as $index => $label)
                        <div class="mb-4 flex items-center">
                            <input id="checkbox-price-{{ $index }}"
                                wire:model.live="priceRanges.{{ $index }}" type="checkbox"
                                class="border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-brand-soft h-4 w-4 border focus:ring-2">
                            <label for="checkbox-price-{{ $index }}"
                                class="text-heading ms-2 select-none text-sm font-medium">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach

                </fieldset>
            </div>
            {{-- end filter by price range --}}

        </div>

        <section id="products" class="grid h-fit flex-1 grid-cols-2 gap-4 lg:grid-cols-3 2xl:grid-cols-4">

            <x-input.basic :divClass="'!mb-0 col-span-full w-full border-default  rounded-lg border bg-white p-2 antialiased shadow-lg lg:p-4 dark:bg-gray-900'" id="search" label="Cari Produk" placeholder="Cari nama produk..."
                type="text" wire:model.live.throttle.500ms="search" errorName="search" />

            @forelse($this->getProducts() as $row)
                <div class="items-center rounded-lg bg-gray-50 shadow dark:border-gray-700 dark:bg-gray-800">
                    <a href="{{ route('product.detail', $row->id) }}">
                        <img class="h-64 w-full rounded-lg object-cover"
                            src="{{ asset('storage/' . $row->product_image_primary) }}"
                            alt="{{ $row->product_name }}">
                    </a>

                    <div class="p-5">
                        <h3 class="text-xl font-bold text-blue-600">
                            <a href="{{ route('product.detail', $row->id) }}">{{ $row->product_name }}</a>
                        </h3>

                        <span class="mb-4 font-semibold text-gray-500 dark:text-gray-400">
                            Rp. {{ number_format($row->price, 2, ',', '.') }}
                        </span>

                        <div class="flex items-center gap-x-1">
                            <ul class="flex">
                                @php
                                    $rating = $row->reviews->avg('rating');
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    <x-icons.star
                                        class="{{ $rating >= $i ? 'text-yellow-400' : 'text-gray-400' }} h-5 w-5" />
                                @endfor
                            </ul>
                            <span class="text-sm">
                                {{ $rating }} ({{ $rating ? $row->reviews->count() : 0 }})
                            </span>
                        </div>

                        <p class="text-gring-gray-500 text-sm dark:text-gray-400">
                            Kategori: {{ $row->category->category_name }}
                        </p>

                        <div class="mt-4 flex flex-col justify-center gap-2 lg:flex-row">
                            <button wire:click="addToCart('{{ $row->id }}')" type="button"
                                class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border cursor-pointer border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                                Keranjang
                            </button>

                            <button type="button"
                                class="bg-pink shadow-xs rounded-base box-border flex cursor-pointer items-center gap-x-1 border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-pink-600 focus:outline-none focus:ring-4 focus:ring-pink-700"
                                wire:click.prevent="addToFavorite('{{ $row->id }}')">
                                @if (auth()->check() && auth()->user()->favoriteProducts->contains($row->id))
                                    <svg class="h-4 w-4 fill-red-700 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1"
                                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                    </svg>

                                    <span>Tersimpan</span>
                                @else
                                    <svg class="h-4 w-4 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1"
                                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                    </svg>

                                    <span>Simpan </span>
                                @endif


                            </button>

                        </div>
                    </div>
                </div>
            @empty
                <h1 class="col-span-full text-center text-2xl font-semibold text-gray-900 dark:text-white">
                    Belum ada data produk terjual.
                </h1>
            @endforelse
        </section>
    </div>

</div>
