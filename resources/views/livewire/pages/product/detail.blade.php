<div class="mx-auto max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => $product->category->category_name, 'subpage' => $product->product_name])

    <section class="rounded-lg bg-white py-8 antialiased shadow-lg md:py-16 dark:bg-gray-900">
        <div class="mx-auto px-4">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="mx-auto flex max-w-md flex-col gap-2 lg:max-w-lg lg:gap-4">
                    <div class="shrink-0">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg"
                            src="{{ asset('storage/' . $product->product_image_primary) }}" alt="Oli MPX">
                    </div>

                    <div class="flex w-full gap-x-2">
                        @foreach ($product->product_images as $image)
                            <img class="h-16 w-16 rounded-lg border border-gray-100 p-2"
                                src="{{ asset('storage/' . $image) }}" alt="Oli MPX">
                        @endforeach
                    </div>
                </div>


                <div class="mt-6 rounded-lg bg-gray-100 p-4 sm:mt-8 lg:mt-0 lg:p-8">
                    @if ($product->stock > 1)
                        <p class="mb-2 inline-block w-fit rounded-sm bg-green-600 px-2 py-1 text-xs text-white">
                            Stock Ready
                        </p>
                    @else
                        <p class="mb-2 inline-block w-fit rounded-sm bg-red-600 px-2 py-1 text-xs text-white">
                            Sold Out
                        </p>
                    @endif

                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $product->product_name }}
                    </h1>

                    <div class="mt-4 sm:flex sm:items-center sm:gap-4">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            Rp{{ number_format($product->price, 2, ',', '.') }}
                        </p>

                        <div class="mt-2 flex items-center gap-2 sm:mt-0">
                            <div class="flex items-center gap-1">
                                @php
                                    $rating = $product->reviews->avg('rating');
                                @endphp

                                @for ($i = 0; $i < floor($rating); $i++)
                                    <x-icons.star class="h-4 w-4 text-yellow-500" />
                                @endfor

                                @for ($i = 5; $i > floor($rating); $i--)
                                    <x-icons.star class="h-4 w-4 text-gray-400" />
                                @endfor
                            </div>
                            <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                ({{ number_format($rating, 1, '.') }})
                            </p>
                            <a href="#ulasan"
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                                {{ $product->reviews->count() }} Ulasan
                            </a>
                        </div>
                    </div>

                    <p class="mt-6 flex text-blue-700">
                        <x-icons.pin-map class="me-2 h-6 w-6 text-blue-700" />
                        Antar ke Alamatmu
                    </p>

                    <div class="mt-6 sm:flex sm:items-center sm:gap-4">
                        <button type="button"
                            class="bg-pink shadow-xs rounded-base box-border flex items-center gap-x-2 border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-pink-600 focus:outline-none focus:ring-4 focus:ring-pink-700"
                            wire:click.prevent="addToFavorite('{{ $product->id }}')">
                            @if (auth()->check() && auth()->user()->favoriteProducts->contains($product->id))
                                <svg class="h-6 w-6 fill-red-700 text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                </svg>

                                <span>Tersimpan</span>
                            @else
                                <svg class="h-6 w-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                </svg>

                                <span>Simpan </span>
                            @endif


                        </button>

                        <button wire:click="addToCart({{ $product->id }})"
                            class="mt-4 flex items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:mt-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            role="button">

                            <x-icons.cart class="-ms-2 me-2 h-5 w-5" />
                            Tambah ke Keranjang
                        </button>
                    </div>

                    <hr class="my-6 border-gray-200 md:my-8 dark:border-gray-800" />

                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ $product->product_description }}
                    </p>
                </div>
            </div>
        </div>

        <section id="ulasan" class="bg-white py-8 antialiased md:py-16 dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                    <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Ulasan Produk</h2>
                        {{-- <div class="mt-6 sm:mt-0">
                            <label for="order-type"
                                class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                review type</label>
                            <select id="order-type"
                                class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                <option selected>All reviews</option>
                                <option value="5">5 stars</option>
                                <option value="4">4 stars</option>
                                <option value="3">3 stars</option>
                                <option value="2">2 stars</option>
                                <option value="1">1 star</option>
                            </select>
                        </div> --}}
                    </div>

                    <div class="mt-6 flow-root sm:mt-8">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($product->reviews as $row)
                                <div class="grid gap-4 pb-4 md:grid-cols-12 md:gap-6 md:pb-6">
                                    <dl class="order-3 md:order-1 md:col-span-3">
                                        <dt class="sr-only">Product:</dt>
                                        <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                            <span class="hover:underline">{{ $product->product_name }}</span>
                                            <p class="text-left text-xs font-normal text-gray-300">Oleh:
                                                <span class="font-semibold">
                                                    {{ $row->user->name }}
                                                </span>
                                            </p>
                                        </dd>
                                    </dl>

                                    <dl class="order-4 md:order-2 md:col-span-6">
                                        <dt class="sr-only">Message:</dt>
                                        <dd class="text-gray-500 dark:text-gray-400">
                                            {{ $row->review }}
                                        </dd>
                                    </dl>

                                    <div
                                        class="order-1 flex content-center items-center justify-between md:order-3 md:col-span-3">
                                        <dl>
                                            <dt class="sr-only">Stars:</dt>
                                            <dd class="flex items-center space-x-1">
                                                @php
                                                    $rating = $row->avg('rating');
                                                @endphp

                                                @for ($i = 0; $i < floor($rating); $i++)
                                                    <x-icons.star class="h-4 w-4 text-yellow-500" />
                                                @endfor

                                                @for ($i = 5; $i > floor($rating); $i--)
                                                    <x-icons.star class="h-4 w-4 text-gray-400" />
                                                @endfor
                                            </dd>
                                        </dl>

                                    </div>
                                </div>

                            @empty
                                <p class="text-center text-sm italic text-gray-800">Belum Ada Ulasan</p>
                            @endforelse
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </section>
</div>
