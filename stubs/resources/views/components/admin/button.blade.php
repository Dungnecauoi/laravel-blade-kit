@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'loading' => false,
    'disabled' => false,
])

@php
    $variants = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-500 focus-visible:outline-primary-600',
        'secondary' => 'bg-white text-neutral-900 ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 focus-visible:outline-primary-600',
        'outline' => 'bg-transparent text-primary-600 ring-1 ring-inset ring-primary-300 hover:bg-primary-50 focus-visible:outline-primary-600',
        'danger' => 'bg-danger-600 text-white hover:bg-danger-500 focus-visible:outline-danger-600',
        'ghost' => 'bg-transparent text-neutral-600 hover:bg-neutral-100 focus-visible:outline-neutral-400 shadow-none',
    ][$variant] ?? '';

    $sizes = [
        'sm' => 'px-2.5 py-1.5 text-xs',
        'md' => 'px-3.5 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
    ][$size] ?? '';

    $classes = "inline-flex items-center justify-center gap-x-1.5 rounded-md font-semibold shadow-sm transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 disabled:cursor-not-allowed disabled:opacity-50 {$variants} {$sizes}";
@endphp

@if($href)
    <a
        href="{{ $disabled ? '#' : $href }}"
        @if($disabled) aria-disabled="true" tabindex="-1" @endif
        {{ $attributes->class([$classes, 'pointer-events-none opacity-50' => $disabled]) }}
    >
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" @if($disabled || $loading) disabled @endif {{ $attributes->class([$classes]) }}>
        @if($loading)
            <x-admin.spinner />
        @endif
        {{ $slot }}
    </button>
@endif
