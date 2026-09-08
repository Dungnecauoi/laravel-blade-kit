@props(['text', 'position' => 'top'])

@php
    $positions = [
        'top' => 'bottom-full left-1/2 mb-2 -translate-x-1/2',
        'bottom' => 'top-full left-1/2 mt-2 -translate-x-1/2',
        'left' => 'right-full top-1/2 mr-2 -translate-y-1/2',
        'right' => 'left-full top-1/2 ml-2 -translate-y-1/2',
    ];

    $positionClasses = $positions[$position] ?? $positions['top'];
@endphp

<span
    x-data="{ show: false }"
    @mouseenter="show = true"
    @mouseleave="show = false"
    @focusin="show = true"
    @focusout="show = false"
    {{ $attributes->class(['relative inline-flex']) }}
>
    {{ $slot }}

    <span
        x-show="show"
        x-transition.duration.100ms
        x-cloak
        role="tooltip"
        class="pointer-events-none absolute z-50 whitespace-nowrap rounded-md bg-neutral-900 px-2 py-1 text-xs font-medium text-white shadow-sm {{ $positionClasses }}"
    >
        {{ $text }}
    </span>
</span>
