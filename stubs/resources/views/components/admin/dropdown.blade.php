@props(['align' => 'right', 'width' => '48'])

@php
    $widthClass = ['48' => 'w-48', '56' => 'w-56', '64' => 'w-64', '72' => 'w-72', '80' => 'w-80'][$width] ?? 'w-48';
    $placement = $align === 'left' ? 'bottom-start' : 'bottom-end';
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
    <div x-ref="trigger" @click="open = ! open">
        {{ $trigger }}
    </div>

    <div
        x-anchor.{{ $placement }}.offset.8="$refs.trigger"
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click="open = false"
        class="z-40 rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 {{ $widthClass }}"
        x-cloak
    >
        {{ $slot }}
    </div>
</div>
