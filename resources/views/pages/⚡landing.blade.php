<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    @include('layouts.app.hero')

    <div class="mx-auto mb-16 w-fit rounded-lg bg-white shadow-lg dark:bg-gray-800">
        @livewire('landing.product-categories')

        @livewire('landing.products')
    </div>
</div>
