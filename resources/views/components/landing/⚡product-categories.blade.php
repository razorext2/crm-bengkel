<?php

use Livewire\Component;

new class extends Component {
    public $categories;

    public function mount()
    {
        $this->categories = \App\Models\ProductCategory::all();
    }
};
?>

<div class="mx-auto flex max-w-screen-xl flex-col gap-2 p-4 lg:gap-4 lg:p-8">

    <h2 class="mb-2 text-4xl font-extrabold text-gray-900 dark:text-white">Kategori</h2>

    <div class="grid w-full grid-cols-2 gap-2 lg:grid-cols-4 lg:gap-4">

        @foreach ($categories as $row)
            <a href="#"
                class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 lg:flex-row dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                <img class="me-2 h-4 w-4 shrink-0 bg-cover" src="{{ asset('storage/' . $row->category_icon) }}" />

                <span class="text-sm font-medium text-gray-900 dark:text-white">
                    {{ $row->category_name }}
                </span>
            </a>
        @endforeach

    </div>

</div>
