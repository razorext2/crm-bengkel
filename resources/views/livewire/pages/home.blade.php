<div>
    @include('layouts.app.customer.hero')

    <div class="mx-auto mb-16 w-fit rounded-lg bg-white shadow-lg dark:bg-gray-800">
        @livewire('pages.utils.categories')

        @livewire('pages.utils.products')
    </div>
</div>
