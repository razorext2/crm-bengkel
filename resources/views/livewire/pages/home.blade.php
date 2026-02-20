<div>
    @include('layouts.app.customer.hero')

    <div
        class="mx-auto mb-20 grid max-w-screen-xl grid-cols-1 gap-4 rounded-lg bg-white p-8 shadow-lg lg:gap-8 lg:p-16 dark:bg-gray-800">
        @livewire('pages.utils.categories')

        @livewire('pages.utils.products')
    </div>
</div>
