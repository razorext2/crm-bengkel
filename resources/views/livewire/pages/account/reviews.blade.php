<div class="mx-auto min-h-max w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Ulasan Saya'])

    <section class="rounded-lg border border-gray-200 bg-white p-4 antialiased shadow-md lg:p-8 dark:bg-gray-900">
        <div class="gap-4 sm:flex sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Ulasan Saya</h2>
        </div>

        <div class="mt-6 flow-root sm:mt-8">
            <div class="divide-y divide-gray-200 dark:divide-gray-700">

                @forelse($data as $row)
                    <div class="grid gap-4 pb-4 md:grid-cols-12 md:gap-6 md:pb-6">
                        <dl class="order-3 md:order-1 md:col-span-3">
                            <dt class="sr-only">Product:</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                <p class="text-sm">#{{ $row->transaction->invoice_number }}</p>
                                <a href="{{ route('product.detail', $row->product_id) }}" class="hover:underline">
                                    {{ $row->product->product_name }}
                                </a>
                                <p class="text-xs font-normal">{{ $row->created_at->format('D, M Y H:i:s') }}</p>
                            </dd>
                        </dl>

                        <dl class="order-4 md:order-2 md:col-span-6">
                            <dt class="sr-only">Message:</dt>
                            <dd class="text-gray-500 dark:text-gray-400">
                                {{ $row->review }}
                            </dd>
                        </dl>

                        <div class="order-1 flex content-center items-center justify-between md:order-3 md:col-span-3">
                            <dl>
                                <dt class="sr-only">Stars:</dt>
                                <dd class="flex items-center space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <x-icons.star
                                            class="{{ $row->rating >= $i ? 'text-yellow-400' : 'text-gray-400' }} h-5 w-5" />
                                    @endfor
                                </dd>
                            </dl>

                        </div>
                    </div>
                @empty
                    <p class="text-center font-semibold">Anda belum memberikan ulasan apapun.</p>
                @endforelse

            </div>

            {{ $data->links() }}
        </div>

    </section>
</div>
