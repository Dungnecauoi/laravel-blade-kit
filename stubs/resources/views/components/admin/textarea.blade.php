@props([
    'label' => null,
    'name',
    'error' => null,
    'hint' => null,
    'required' => false,
    'rows' => 4,
    'variant' => 'outline',
    'autosize' => false,
])

@php
    $value = old($name, $attributes->get('value'));

    $variants = [
        'outline' => $error
            ? 'ring-1 ring-inset ring-danger-300 focus:ring-2 focus:ring-danger-500'
            : 'ring-1 ring-inset ring-neutral-300 focus:ring-2 focus:ring-primary-600',
        'filled' => $error
            ? 'bg-danger-50 focus:bg-white focus:ring-2 focus:ring-danger-500'
            : 'bg-neutral-100 focus:bg-white focus:ring-2 focus:ring-primary-600',
    ];
    $variantClass = $variants[$variant] ?? $variants['outline'];
@endphp

<div>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if($autosize)
            x-data
            x-init="$el.style.height = $el.scrollHeight + 'px'"
            @input="$el.style.height = 'auto'; $el.style.height = $el.scrollHeight + 'px'"
            style="overflow: hidden; resize: none;"
        @endif
        {{ $attributes->except('value')->class(["block w-full rounded-md border-0 py-1.5 text-neutral-900 shadow-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {$variantClass}"]) }}
    >{{ $value }}</textarea>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
