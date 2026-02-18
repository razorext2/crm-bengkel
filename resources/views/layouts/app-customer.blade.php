<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="relative flex min-h-screen flex-col bg-gray-50">
    @include('layouts.app.customer.navbar')

    <div class="flex-1">
        {{ $slot }}
    </div>

    @include('layouts.app.customer.footer')

    {{-- js --}}
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>
