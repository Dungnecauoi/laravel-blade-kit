@props(['label' => null, 'name', 'min' => 0, 'max' => 100, 'step' => 1, 'hint' => null])

<div x-data="{ value: @js((float) old($name, $attributes->get('value', $min))) }">
    @if($label)
        <div class="mb-1 flex items-center justify-between">
            <x-admin.label :for="$name">{{ $label }}</x-admin.label>
            <span class="text-sm text-neutral-500" x-text="value"></span>
        </div>
    @endif

    <input
        type="range"
        name="{{ $name }}"
        id="{{ $name }}"
        x-model.number="value"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        {{ $attributes->except('value')->class(['h-2 w-full cursor-pointer appearance-none rounded-full bg-neutral-200 accent-primary-600 focus:outline-none']) }}
    />

    @if($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
