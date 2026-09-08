@props(['items' => [], 'selectable' => false])

<ul {{ $attributes->class(['space-y-0.5']) }}>
    @foreach($items as $item)
        <li>
            @if(! empty($item['children']))
                <div x-data="{ open: {{ ($item['open'] ?? false) ? 'true' : 'false' }} }">
                    <div class="group flex items-center gap-x-1.5 rounded-md px-1.5 py-1 hover:bg-neutral-50">
                        <button
                            type="button"
                            @click="open = ! open"
                            class="flex h-5 w-5 shrink-0 items-center justify-center rounded text-neutral-400 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        >
                            <span class="sr-only">{{ __('Mở rộng') }}</span>
                            <x-admin.icon name="chevron-right" class="h-3.5 w-3.5 transition-transform" x-bind:class="{ 'rotate-90': open }" />
                        </button>

                        @if($selectable)
                            <input type="checkbox" @checked($item['checked'] ?? false) aria-label="{{ $item['label'] }}" class="h-3.5 w-3.5 rounded border-neutral-300 accent-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-1">
                        @endif

                        <x-admin.icon :name="$item['icon'] ?? 'folder'" class="h-4 w-4 shrink-0 text-neutral-400" />
                        <span class="truncate text-sm text-neutral-700">{{ $item['label'] }}</span>
                    </div>

                    <div x-show="open" x-collapse.duration.150ms x-cloak class="ml-2.5 space-y-0.5 border-l border-neutral-100 pl-3.5">
                        <x-admin.tree-view :items="$item['children']" :selectable="$selectable" />
                    </div>
                </div>
            @else
                <div class="group flex items-center gap-x-1.5 rounded-md px-1.5 py-1 hover:bg-neutral-50">
                    <span class="h-5 w-5 shrink-0"></span>

                    @if($selectable)
                        <input type="checkbox" @checked($item['checked'] ?? false) aria-label="{{ $item['label'] }}" class="h-3.5 w-3.5 rounded border-neutral-300 accent-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-1">
                    @endif

                    <x-admin.icon :name="$item['icon'] ?? 'circle'" class="h-4 w-4 shrink-0 text-neutral-400" />
                    <span class="truncate text-sm text-neutral-700">{{ $item['label'] }}</span>
                </div>
            @endif
        </li>
    @endforeach
</ul>
