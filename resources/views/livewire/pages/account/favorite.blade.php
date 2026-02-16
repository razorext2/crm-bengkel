<div class="mx-auto w-full max-w-screen-xl p-4 lg:p-8">
    <section class="bg-gray-50 py-8 antialiased md:py-12 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>
                    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Favorit'])

                    <h2 class="mt-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Favorit</h2>
                </div>

            </div>
            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                @forelse ($this->products as $row)
                    <div class="items-center rounded-lg bg-gray-50 shadow dark:border-gray-700 dark:bg-gray-800">
                        <a href="{{ route('product.detail', $row->id) }}">
                            <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                                src="{{ asset('storage/' . $row->product_image_primary) }}" alt="Oli MPX">
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

                                    @for ($i = 0; $i < floor($rating); $i++)
                                        <li>
                                            <x-icons.star class="h-4 w-4 text-yellow-500" />
                                        </li>
                                    @endfor

                                    @for ($i = 5; $i > floor($rating); $i--)
                                        <li>
                                            <x-icons.star class="h-4 w-4 text-gray-400" />
                                        </li>
                                    @endfor
                                </ul>

                                <span class="text-sm"> ({{ $rating ? $row->reviews->count() : 0 }}) </span>
                            </div>

                            <p class="text-gring-gray-500 text-sm dark:text-gray-400">Kategori:
                                {{ $row->category->category_name }}</p>

                            <div class="mt-4 flex flex-col justify-center gap-2 lg:flex-row">
                                <button type="button"
                                    class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                                    Checkout
                                </button>

                                <button type="button"
                                    class="bg-pink shadow-xs rounded-base box-border flex items-center gap-x-2 border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-pink-600 focus:outline-none focus:ring-4 focus:ring-pink-700"
                                    wire:click.prevent="addToFavorite('{{ $row->id }}')">
                                    @if (auth()->user()->favoriteProducts->contains($row->id))
                                        <svg class="h-6 w-6 fill-red-700 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                        </svg>

                                        <span>Tersimpan</span>
                                    @else
                                        <svg class="h-6 w-6 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                        </svg>

                                        <span>Simpan </span>
                                    @endif


                                </button>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-4 w-full rounded-lg bg-white p-16 text-center text-gray-800">
                        <p class="text-2xl font-semibold">Belum ada produk yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
