@php
    $sidebarVariant = config('admin.sidebar_variant', 'dark');
    $isDark = $sidebarVariant !== 'light';
@endphp

<div class="flex grow flex-col gap-y-5 overflow-y-auto {{ $isDark ? 'bg-neutral-900' : 'bg-white ring-1 ring-neutral-200' }} px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center justify-between {{ $isDark ? 'text-white' : 'text-neutral-900' }}">
        <div class="flex items-center gap-x-2 overflow-hidden">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary-600 text-sm font-bold text-white">
                {{ mb_substr(config('admin.name'), 0, 1) }}
            </span>
            <span class="whitespace-nowrap text-base font-semibold" x-show="! sidebarCollapsed" x-cloak>{{ config('admin.name') }}</span>
        </div>

        <button
            type="button"
            @click="sidebarCollapsed = ! sidebarCollapsed"
            class="hidden shrink-0 rounded p-1 lg:block {{ $isDark ? 'text-neutral-400 hover:bg-neutral-800 hover:text-white' : 'text-neutral-400 hover:bg-neutral-100 hover:text-neutral-700' }}"
        >
            <span class="sr-only">{{ __('Thu gọn menu') }}</span>
            <x-admin.icon name="chevron-right" class="h-4 w-4 transition-transform" x-bind:class="{ 'rotate-180': ! sidebarCollapsed }" />
        </button>
    </div>

    <nav class="flex flex-1 flex-col">
        <ul class="flex flex-1 flex-col gap-y-1">
            @foreach($menuItems as $item)
                <li>
                    <x-admin.sidebar-item :item="$item" :variant="$sidebarVariant" />
                </li>
            @endforeach
        </ul>
    </nav>
</div>
