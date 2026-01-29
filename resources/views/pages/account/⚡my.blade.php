<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="mx-auto w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb')

    <div class="flex gap-4 lg:gap-8">
        <div class="h-96 w-80 shrink rounded-lg border border-gray-200 bg-white p-2 shadow-md lg:p-4" id="profile-menu">
            <div class="flex items-center gap-2 border-b border-gray-200 pb-2">
                <div class="shrink-0">
                    <img class="h-8 w-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"
                        alt="Neil image">
                </div>
                <div class="ms-2 min-w-0 flex-1">
                    <p class="text-heading truncate font-medium">
                        Neil Sims
                    </p>
                    <p class="text-body truncate text-sm">
                        email@windster.com
                    </p>
                </div>
            </div>

            <div class="py grid grid-cols-3 gap-x-2 py-4 lg:gap-x-4">

                <a href="#" class="flex w-full items-center justify-center rounded-md bg-green-500 p-2 lg:p-4">
                    <x-icon.gear class="h-4 w-4 text-green-700" />
                </a>

                <a href="#" class="flex w-full items-center justify-center rounded-md bg-green-500 p-2 lg:p-4">
                    <x-icon.gear class="h-4 w-4 text-green-700" />
                </a>

                <a href="#" class="flex w-full items-center justify-center rounded-md bg-green-500 p-2 lg:p-4">
                    <x-icon.gear class="h-4 w-4 text-green-700" />
                </a>

            </div>

        </div>

        <div id="profile-menu" class="h-96 w-full rounded-lg border border-gray-200 bg-white p-4 shadow-md lg:p-8">
        </div>
    </div>

</div>
