@props([
    'label' => null,
    'name',
    'error' => null,
    'hint' => null,
    'required' => false,
    'min' => null,
    'max' => null,
])

@php
    $value = old($name, $attributes->get('value'));
    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
@endphp

<div>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <div class="relative">
        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <x-admin.icon name="clock" class="h-4 w-4 text-neutral-400" />
        </span>

        <input
            type="time"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            @if($min) min="{{ $min }}" @endif
            @if($max) max="{{ $max }}" @endif
            {{ $attributes->except('value')->class(["block w-full rounded-md border-0 py-2.5 pl-9 pr-3 text-neutral-900 shadow-sm ring-1 ring-inset focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6 {$ringClass}"]) }}
        />
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
