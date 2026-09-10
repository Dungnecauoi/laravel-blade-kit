@props([])

<div
    {{ $attributes->class([
        'inline-flex isolate -space-x-px rounded-md shadow-sm',
        '[&>*]:relative [&>*:hover]:z-10 [&>*:focus]:z-10',
        '[&>*:not(:first-child)]:rounded-l-none [&>*:not(:last-child)]:rounded-r-none',
    ]) }}
    role="group"
>
    {{ $slot }}
</div>
