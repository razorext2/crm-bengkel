@props([
    'id' => 'basicInput',
    'placeholder' => '',
    'label' => '',
    'rows' => '4',
    'errorName' => 'default.error',
])

<div class="mb-5">
    <label for="{{ $id }}" class="text-heading mb-2.5 block text-sm font-medium">{{ $label }}</label>
    <textarea id="{{ $id }}" name="{{ $id }}" rows="{{ $rows }}"
        class="bg-neutral-secondary-medium border-default-medium text-heading rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body block w-full border p-3.5 text-sm"
        placeholder="{{ $placeholder }}" {{ $attributes }}></textarea>

    @error($errorName)
        <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
