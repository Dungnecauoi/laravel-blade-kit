@props(['value', 'title'])

<div>
    <button
        type="button"
        @click="activeItem = activeItem === '{{ $value }}' ? null : '{{ $value }}'"
        class="flex w-full items-center justify-between px-5 py-4 text-left text-sm font-medium text-neutral-900 hover:bg-neutral-50"
    >
        {{ $title }}
        <x-admin.icon name="chevron-down" class="h-4 w-4 shrink-0 text-neutral-400 transition-transform" x-bind:class="{ 'rotate-180': activeItem === '{{ $value }}' }" />
    </button>

    <div x-show="activeItem === '{{ $value }}'" x-collapse.duration.150ms x-cloak class="px-5 pb-4 text-sm text-neutral-600">
        {{ $slot }}
    </div>
</div>
