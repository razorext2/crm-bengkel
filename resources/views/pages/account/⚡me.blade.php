<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="mx-auto w-full max-w-screen-xl p-4 lg:p-8">
    @livewire('utils.breadcumb', ['page' => 'Akun', 'subpage' => 'Profil Saya'])

    <div class="flex gap-4 lg:gap-8">
        <div class="flex h-fit w-80 shrink flex-col gap-2 rounded-lg border border-gray-200 bg-white p-2 shadow-md lg:gap-4 lg:p-4"
            id="profile-menu">
            <div id="profile-information" class="flex items-center gap-2">
                <div class="shrink-0">
                    <img class="h-8 w-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"
                        alt="Neil image">
                </div>
                <div class="ms-2 min-w-0 flex-1">
                    <p class="text-heading truncate font-medium">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-body truncate text-sm">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>

            <div id="quick-access" class="grid grid-cols-3 gap-x-2 lg:gap-x-4">

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

            <ul id="menu-list" class="w-full">
                <li>
                    <a href="{{ route('account.order') }}"
                        class="flex items-center rounded-md p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <x-icon.gear class="me-2 h-4 w-4 shrink-0 text-gray-900 dark:text-white" />
                        <span>Pesanan Saya</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center rounded-md p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <x-icon.gear class="me-2 h-4 w-4 shrink-0 text-gray-900 dark:text-white" />
                        <span>Penilaian Saya</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center rounded-md p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <x-icon.gear class="me-2 h-4 w-4 shrink-0 text-gray-900 dark:text-white" />
                        <span>Alamat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.favorite') }}"
                        class="flex items-center rounded-md p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <x-icon.gear class="me-2 h-4 w-4 shrink-0 text-gray-900 dark:text-white" />
                        <span>Favorit</span>
                    </a>
                </li>
            </ul>

            <ul id="link-list" class="w-full">
                <li>
                    <a href="{{ route('account.settings') }}"
                        class="flex items-center rounded-md p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <x-icon.gear class="me-2 h-4 w-4 shrink-0 text-gray-900 dark:text-white" />
                        <span>Pengaturan</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center rounded-md p-2 text-red-500 hover:bg-red-100 dark:hover:bg-red-700">
                        <x-icon.gear class="me-2 h-4 w-4 shrink-0" />
                        <span>Logout</span>
                    </a>
                </li>
            </ul>

        </div>

        <div id="content" class="flex w-full flex-col gap-2 lg:gap-4">
            <div class="flex w-full justify-between gap-2 lg:gap-4">
                <div class="flex max-w-sm grow items-center gap-2">
                    <input type="email" id="email-alternative"
                        class="bg-neutral-secondary-medium border-default-medium text-heading rounded-base focus:ring-brand focus:border-brand placeholder:text-body block w-full border px-3 py-2.5 text-sm shadow"
                        placeholder="Cari data..." required />

                    <button type="submit"
                        class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">Submit</button>
                </div>

                <div>
                    <select id="countries"
                        class="bg-neutral-secondary-medium border-default-medium text-heading rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body block w-full border px-3 py-2.5 text-sm">
                        <option selected>Filter</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col gap-2 lg:gap-4">
                <div
                    class="flex flex-col gap-2 rounded-lg border border-gray-200 bg-white p-2 shadow-md lg:gap-4 lg:p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                class="w-10" />

                            <div>
                                <a href="#"
                                    class="textgray-800 flex items-center gap-x-2 text-lg hover:underline">
                                    Apple iMac 27", 1TB HDD, Retina 5K <span
                                        class="rounded-md bg-yellow-600 px-4 py-0.5 text-xs text-yellow-800">Pending</span>
                                </a>

                                <p class="text-base text-gray-600">
                                    Rp. XXX.XXX,-
                                </p>
                            </div>
                        </div>

                        <button type="button"
                            class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border h-fit w-fit border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                            Refund </button>
                    </div>
                </div>

                <div
                    class="flex flex-col gap-2 rounded-lg border border-gray-200 bg-white p-2 shadow-md lg:gap-4 lg:p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                class="w-10" />

                            <div>
                                <a href="#"
                                    class="textgray-800 flex items-center gap-x-2 text-lg hover:underline">
                                    Apple iMac 27", 1TB HDD, Retina 5K <span
                                        class="rounded-md bg-yellow-600 px-4 py-0.5 text-xs text-yellow-800">Pending</span>
                                </a>

                                <p class="text-base text-gray-600">
                                    Rp. XXX.XXX,-
                                </p>
                            </div>
                        </div>

                        <button type="button"
                            class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border h-fit w-fit border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                            Refund </button>
                    </div>
                </div>

                <div
                    class="flex flex-col gap-2 rounded-lg border border-gray-200 bg-white p-2 shadow-md lg:gap-4 lg:p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                class="w-10" />

                            <div>
                                <a href="#"
                                    class="textgray-800 flex items-center gap-x-2 text-lg hover:underline">
                                    Apple iMac 27", 1TB HDD, Retina 5K <span
                                        class="rounded-md bg-yellow-600 px-4 py-0.5 text-xs text-yellow-800">Pending</span>
                                </a>

                                <p class="text-base text-gray-600">
                                    Rp. XXX.XXX,-
                                </p>
                            </div>
                        </div>

                        <button type="button"
                            class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border h-fit w-fit border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                            Refund </button>
                    </div>
                </div>

                <div
                    class="flex flex-col gap-2 rounded-lg border border-gray-200 bg-white p-2 shadow-md lg:gap-4 lg:p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                class="w-10" />

                            <div>
                                <a href="#"
                                    class="textgray-800 flex items-center gap-x-2 text-lg hover:underline">
                                    Apple iMac 27", 1TB HDD, Retina 5K <span
                                        class="rounded-md bg-yellow-600 px-4 py-0.5 text-xs text-yellow-800">Pending</span>
                                </a>

                                <p class="text-base text-gray-600">
                                    Rp. XXX.XXX,-
                                </p>
                            </div>
                        </div>

                        <button type="button"
                            class="bg-brand hover:bg-brand-strong focus:ring-brand-medium shadow-xs rounded-base box-border h-fit w-fit border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4">
                            Refund </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
