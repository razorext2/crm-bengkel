@props([
    'type' => 'button',
    'class' => '',
])

<button type="{{ $type }}"
    class="bg-danger hover:bg-danger-strong focus:ring-danger-medium shadow-xs rounded-base {{ $class }} box-border border border-transparent px-4 py-2.5 text-sm font-medium leading-5 text-white focus:outline-none focus:ring-4"
    {{ $attributes }}>
    {{ $slot }}
</button>
