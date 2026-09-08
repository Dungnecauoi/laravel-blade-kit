@props([
    'label' => null,
    'name',
    'min' => null,
    'max' => null,
    'step' => 1,
    'error' => null,
    'hint' => null,
    'required' => false,
])

@php
    $value = old($name, $attributes->get('value', 0));
    $ringClass = $error ? 'ring-danger-300 focus-within:ring-danger-500' : 'ring-neutral-300 focus-within:ring-primary-600';
@endphp

<div
    x-data="{
        value: @js((float) $value),
        min: @js($min !== null ? (float) $min : null),
        max: @js($max !== null ? (float) $max : null),
        step: @js((float) $step),
        inc() { this.value = this.max !== null ? Math.min(this.max, this.value + this.step) : this.value + this.step; },
        dec() { this.value = this.min !== null ? Math.max(this.min, this.value - this.step) : this.value - this.step; },
    }"
>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <div class="flex rounded-md shadow-sm ring-1 ring-inset focus-within:ring-2 {{ $ringClass }}">
        <button type="button" @click="dec()" class="flex items-center justify-center rounded-l-md px-3 text-neutral-500 hover:bg-neutral-50" tabindex="-1">
            <span class="sr-only">{{ __('Giảm') }}</span>
            <x-admin.icon name="minus" class="h-4 w-4" />
        </button>

        <input
            type="number"
            name="{{ $name }}"
            id="{{ $name }}"
            x-model.number="value"
            @if($min !== null) min="{{ $min }}" @endif
            @if($max !== null) max="{{ $max }}" @endif
            step="{{ $step }}"
            {{ $attributes->except('value')->class(['w-full border-0 bg-transparent text-center text-sm text-neutral-900 focus:outline-none focus:ring-0 [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none']) }}
        />

        <button type="button" @click="inc()" class="flex items-center justify-center rounded-r-md px-3 text-neutral-500 hover:bg-neutral-50" tabindex="-1">
            <span class="sr-only">{{ __('Tăng') }}</span>
            <x-admin.icon name="plus" class="h-4 w-4" />
        </button>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
