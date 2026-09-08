@props([
    'label' => null,
    'name',
    'options' => [],
    'placeholder' => null,
    'error' => null,
    'hint' => null,
    'required' => false,
    'variant' => 'outline',
])

@php
    $selected = old($name, $attributes->get('value'));

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

    <div class="relative">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->except('value')->class(["block w-full appearance-none rounded-md border-0 py-1.5 pl-3 pr-9 text-neutral-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {$variantClass}"]) }}
        >
            @if($placeholder)
                <option value="" disabled @selected($selected === null)>{{ $placeholder }}</option>
            @endif

            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected((string) $selected === (string) $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>

        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
            <x-admin.icon name="chevron-up-down" class="h-4 w-4 text-neutral-400" />
        </span>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
