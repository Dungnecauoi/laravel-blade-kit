@props(['item'])

@if(!empty($item['children']))
    <div x-data="{ open: {{ $item['active'] ? 'true' : 'false' }} }">
        <button
            type="button"
            @click="open = ! open"
            class="group flex w-full items-center justify-between rounded-md p-2 text-sm font-semibold text-neutral-300 hover:bg-neutral-800 hover:text-white"
        >
            <span class="flex items-center gap-x-3">
                <x-admin.icon :name="$item['icon'] ?? 'folder'" class="h-5 w-5 shrink-0" />
                {{ $item['label'] }}
            </span>
            <x-admin.icon name="chevron-down" class="h-4 w-4 shrink-0 transition-transform" x-bind:class="{ 'rotate-180': open }" />
        </button>

        <div x-show="open" x-collapse.duration.150ms x-cloak class="mt-1 space-y-1 pl-8">
            @foreach($item['children'] as $child)
                <x-admin.sidebar-item :item="$child" />
            @endforeach
        </div>
    </div>
@else
    <a
        href="{{ $item['url'] }}"
        @class([
            'group flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold',
            'bg-neutral-800 text-white' => $item['active'],
            'text-neutral-400 hover:bg-neutral-800 hover:text-white' => ! $item['active'],
        ])
    >
        <x-admin.icon :name="$item['icon'] ?? 'circle'" class="h-5 w-5 shrink-0" />
        {{ $item['label'] }}
    </a>
@endif
