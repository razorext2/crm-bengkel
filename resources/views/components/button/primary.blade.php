@props([
    'type' => 'button',
    'class' => '',
])

<button type="{{ $type }}"
    class="shadow-xs rounded-base {{ $class }} box-border border border-transparent bg-blue-700 px-4 py-2.5 text-sm font-medium leading-5 text-white hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-400"
    {{ $attributes }}>
    {{ $slot }}
</button>
