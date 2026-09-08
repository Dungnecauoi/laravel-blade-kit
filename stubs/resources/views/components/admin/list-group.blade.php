@props([])

<ul {{ $attributes->class(['divide-y divide-neutral-200 overflow-hidden rounded-lg ring-1 ring-neutral-200']) }}>
    {{ $slot }}
</ul>
