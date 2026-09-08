@props(['default' => null])

<div x-data="{ activeItem: @js($default) }" {{ $attributes->class(['divide-y divide-neutral-200 rounded-xl ring-1 ring-neutral-200']) }}>
    {{ $slot }}
</div>
