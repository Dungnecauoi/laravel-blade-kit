@props(['title' => null, 'width' => '64', 'on' => 'click'])

@php
    $widthClass = ['56' => 'w-56', '64' => 'w-64', '72' => 'w-72', '80' => 'w-80'][$width] ?? 'w-64';
@endphp

<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    class="relative inline-flex"
>
    <span
        x-ref="trigger"
        @if($on === 'hover')
            @mouseenter="open = true" @mouseleave="open = false"
        @else
            @click="open = ! open"
        @endif
    >
        {{ $trigger }}
    </span>

    <div
        x-anchor.bottom-start.offset.8="$refs.trigger"
        x-show="open"
        x-transition.duration.100ms
        x-cloak
        role="tooltip"
        class="z-40 {{ $widthClass }} rounded-md bg-white text-sm text-neutral-600 shadow-lg ring-1 ring-black/5"
    >
        @if($title)
            <div class="border-b border-neutral-100 px-3 py-2">
                <h3 class="text-sm font-semibold text-neutral-900">{{ $title }}</h3>
            </div>
        @endif

        <div class="px-3 py-2">
            {{ $slot }}
        </div>
    </div>
</div>
