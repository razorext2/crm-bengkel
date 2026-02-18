<section class="bg-gray-50 dark:bg-gray-900">
    <div class="mx-auto grid max-w-screen-xl px-4 py-8 lg:grid-cols-12 lg:gap-8 lg:py-16 xl:gap-0">
        <div class="mr-auto place-self-center lg:col-span-7">

            <h1 class="mb-4 max-w-2xl text-4xl font-extrabold md:text-5xl xl:text-6xl dark:text-white">
                Teman bengkel andalanmu
            </h1>

            <p class="mb-6 max-w-2xl font-light text-gray-500 md:text-lg lg:mb-8 lg:text-xl dark:text-gray-400">
                Temukan apapun yang ingin kamu cari disini. Oli? sparepart? tool? ban? apapun ada! Silahkan bergabung
                dan mulailah berbelanja.
            </p>

            @if (auth()->check())
                <a href="#"
                    class="mr-3 inline-flex items-center justify-center rounded-lg bg-blue-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Mulai
                    <svg class="-mr-1 ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-green-500 px-5 py-3 text-center text-base font-medium text-gray-900 hover:bg-green-100 focus:ring-4 focus:ring-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-green-700 dark:focus:ring-gray-800">
                    Masuk
                </a>
            @endif
        </div>

        <div class="hidden lg:col-span-5 lg:mt-0 lg:flex">
            <img src="{{ asset('img/moljaya.jpg') }}" alt="mockup">
        </div>
    </div>
</section>
