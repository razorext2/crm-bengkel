@props([
    'id' => 'basicSelect',
    'defaultOption' => 'Pilih...',
    'options' => [],
    'label' => '',
    'errorName' => null,
    'valueField' => 'id',
    'labelField' => 'name',
    'divClass' => '',
])

@php
    $selectedValue = old($attributes->wire('model')->value() ?? $attributes->get('name'));
@endphp

<div class="{{ $divClass }} mb-5">
    @if ($label)
        <label for="{{ $id }}" class="text-heading mb-2.5 block text-sm font-medium">
            {{ $label }}
        </label>
    @endif

    <select id="{{ $id }}"
        {{ $attributes->merge([
            'class' =>
                'bg-neutral-secondary-medium border-default-medium text-heading rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body block w-full border px-3 py-2.5 text-sm',
        ]) }}>
        <option value="">{{ $defaultOption }}</option>

        @foreach ($options as $row)
            <option value="{{ $row[$valueField] }}" @selected($selectedValue == $row[$valueField])>
                {{ $row[$labelField] }}
            </option>
        @endforeach
    </select>

    @if ($errorName)
        @error($errorName)
            <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
        @enderror
    @endif
</div>
