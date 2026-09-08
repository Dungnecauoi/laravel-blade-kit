@props(['circle' => false])

<div
    {{ $attributes->except('class') }}
    class="{{ $attributes->get('class') ?: ($circle ? 'h-10 w-10 rounded-full' : 'h-4 w-full rounded') }} animate-pulse bg-neutral-200"
    aria-hidden="true"
></div>
