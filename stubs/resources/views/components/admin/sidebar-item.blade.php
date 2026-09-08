@props(['item', 'variant' => 'dark'])

@php
    $isDark = $variant !== 'light';

    $inactiveText = $isDark ? 'text-neutral-400 hover:bg-neutral-800 hover:text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900';
    $activeClass = $isDark ? 'bg-neutral-800 text-white' : 'bg-primary-50 text-primary-700';
    $groupText = $isDark ? 'text-neutral-300 hover:bg-neutral-800 hover:text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-neutral-900';
@endphp

@if(!empty($item['children']))
    <div x-data="{ open: {{ $item['active'] ? 'true' : 'false' }} }">
        <button
            type="button"
            :title="sidebarCollapsed ? @js($item['label']) : null"
            @click="if (sidebarCollapsed) { sidebarCollapsed = false; open = true } else { open = ! open }"
            class="group flex w-full items-center justify-between rounded-md p-2 text-sm font-semibold {{ $groupText }}"
        >
            <span class="flex items-center gap-x-3">
                <x-admin.icon :name="$item['icon'] ?? 'folder'" class="h-5 w-5 shrink-0" />
                <span x-show="! sidebarCollapsed" x-cloak>{{ $item['label'] }}</span>
            </span>
            <x-admin.icon name="chevron-down" class="h-4 w-4 shrink-0 transition-transform" x-bind:class="{ 'rotate-180': open }" x-show="! sidebarCollapsed" />
        </button>

        <div x-show="open && ! sidebarCollapsed" x-collapse.duration.150ms x-cloak class="mt-1 space-y-1 pl-8">
            @foreach($item['children'] as $child)
                <x-admin.sidebar-item :item="$child" :variant="$variant" />
            @endforeach
        </div>
    </div>
@else
    <a
        href="{{ $item['url'] }}"
        :title="sidebarCollapsed ? @js($item['label']) : null"
        @class([
            'group flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold',
            $activeClass => $item['active'],
            $inactiveText => ! $item['active'],
        ])
    >
        <x-admin.icon :name="$item['icon'] ?? 'circle'" class="h-5 w-5 shrink-0" />
        <span x-show="! sidebarCollapsed" x-cloak>{{ $item['label'] }}</span>
    </a>
@endif
