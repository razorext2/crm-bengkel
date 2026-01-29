<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    @include('layouts.app.hero')

    <div class="mx-auto mb-16 w-fit rounded-lg bg-white shadow-lg dark:bg-gray-800">
        @include('layouts.app.categories')

        @include('layouts.app.products')
    </div>
</div>
