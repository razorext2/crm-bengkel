@props([
    'id' => 'basicInput',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'label' => '',
    'errorName' => 'default.error',
    'divClass' => '',
])

<div class="{{ $divClass }} mb-5">
    @if ($label)
        <label for="{{ $id }}" class="text-heading mb-2.5 block text-sm font-medium">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $id }}"
        class="bg-neutral-secondary-medium border-default-medium text-heading rounded-base focus:ring-brand focus:border-brand placeholder:text-body block w-full border px-3 py-2.5 text-sm shadow"
        placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes }} />

    @error($errorName)
        <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
