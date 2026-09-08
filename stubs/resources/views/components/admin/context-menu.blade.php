@props(['width' => '48'])

@php
    $widthClass = ['48' => 'w-48', '56' => 'w-56', '64' => 'w-64'][$width] ?? 'w-48';
@endphp

<div
    x-data="{ open: false, x: 0, y: 0 }"
    @contextmenu.prevent="open = true; x = $event.clientX; y = $event.clientY"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
>
    {{ $trigger }}

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        @click="open = false"
        :style="`top: ${y}px; left: ${x}px;`"
        class="fixed z-50 rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 {{ $widthClass }}"
        x-cloak
    >
        {{ $slot }}
    </div>
</div>
