@props([])

<svg {{ $attributes->except('class') }} class="{{ $attributes->get('class') ? $attributes->get('class').' animate-spin' : 'h-4 w-4 animate-spin' }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
    <circle class="opacity-25" cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3"></circle>
    <path class="opacity-75" fill="currentColor" d="M21 12a9 9 0 0 0-9-9v3a6 6 0 0 1 6 6h3Z"></path>
</svg>
