<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-neutral-900 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center gap-x-2 text-white">
        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-sm font-bold">
            {{ mb_substr(config('admin.name'), 0, 1) }}
        </span>
        <span class="text-base font-semibold">{{ config('admin.name') }}</span>
    </div>

    <nav class="flex flex-1 flex-col">
        <ul class="flex flex-1 flex-col gap-y-1">
            @foreach($menuItems as $item)
                <li>
                    <x-admin.sidebar-item :item="$item" />
                </li>
            @endforeach
        </ul>
    </nav>
</div>
