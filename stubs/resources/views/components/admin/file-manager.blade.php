@props(['files' => []])

@php
    $typeIcon = [
        'folder' => 'folder',
        'image' => 'image',
        'archive' => 'box',
    ];
@endphp

<div
    x-data="{
        files: @js($files),
        query: '',
        view: 'grid',
        typeIcon: @js($typeIcon),
        get filtered() {
            return this.query === ''
                ? this.files
                : this.files.filter((f) => f.name.toLowerCase().includes(this.query.toLowerCase()));
        },
        icon(file) { return this.typeIcon[file.type] ?? 'document'; },
    }"
    {{ $attributes->class(['rounded-xl bg-white ring-1 ring-neutral-200']) }}
>
    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-neutral-200 p-3">
        <div class="relative w-full max-w-xs">
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <x-admin.icon name="search" class="h-4 w-4 text-neutral-400" />
            </span>
            <input
                type="text"
                x-model="query"
                placeholder="{{ __('Tìm kiếm file...') }}"
                class="block w-full rounded-md border-0 py-2.5 pl-9 pr-3 text-sm text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-600"
            >
        </div>

        <div class="flex items-center gap-x-2">
            <div class="flex items-center rounded-md ring-1 ring-neutral-200">
                <button type="button" @click="view = 'grid'" :class="view === 'grid' ? 'bg-primary-50 text-primary-600' : 'text-neutral-400 hover:text-neutral-600'" class="flex h-8 w-8 items-center justify-center rounded-l-md">
                    <span class="sr-only">{{ __('Dạng lưới') }}</span>
                    <x-admin.icon name="grid" class="h-4 w-4" />
                </button>
                <button type="button" @click="view = 'list'" :class="view === 'list' ? 'bg-primary-50 text-primary-600' : 'text-neutral-400 hover:text-neutral-600'" class="flex h-8 w-8 items-center justify-center rounded-r-md border-l border-neutral-200">
                    <span class="sr-only">{{ __('Dạng danh sách') }}</span>
                    <x-admin.icon name="list-bullet" class="h-4 w-4" />
                </button>
            </div>

            <label class="inline-flex cursor-pointer items-center gap-x-1.5 rounded-md bg-primary-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                <x-admin.icon name="upload" class="h-4 w-4" />
                {{ __('Tải lên') }}
                <input type="file" multiple class="hidden">
            </label>
        </div>
    </div>

    <div class="p-3">
        <template x-if="filtered.length === 0">
            <x-admin.empty-state icon="folder" :title="__('Không tìm thấy file nào')" />
        </template>

        <div x-show="view === 'grid' && filtered.length > 0" class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
            <template x-for="file in filtered" :key="file.name">
                <div class="group flex flex-col items-center gap-y-2 rounded-lg p-3 text-center hover:bg-neutral-50">
                    <template x-if="file.type === 'image' && file.url">
                        <img :src="file.url" :alt="file.name" class="h-16 w-16 rounded-md object-cover ring-1 ring-neutral-200">
                    </template>
                    <template x-if="! (file.type === 'image' && file.url)">
                        <span class="flex h-16 w-16 items-center justify-center rounded-md bg-neutral-100 text-neutral-400">
                            <x-admin.icon name="document" class="h-7 w-7" x-show="icon(file) === 'document'" />
                            <x-admin.icon name="folder" class="h-7 w-7" x-show="icon(file) === 'folder'" />
                            <x-admin.icon name="image" class="h-7 w-7" x-show="icon(file) === 'image'" />
                            <x-admin.icon name="box" class="h-7 w-7" x-show="icon(file) === 'box'" />
                        </span>
                    </template>
                    <p class="w-full truncate text-xs font-medium text-neutral-700" x-text="file.name"></p>
                    <p class="text-[11px] text-neutral-400" x-text="file.size"></p>
                </div>
            </template>
        </div>

        <ul x-show="view === 'list' && filtered.length > 0" class="divide-y divide-neutral-100">
            <template x-for="file in filtered" :key="file.name">
                <li class="flex items-center gap-x-3 py-2.5">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-neutral-100 text-neutral-400">
                        <x-admin.icon name="document" class="h-4 w-4" x-show="icon(file) === 'document'" />
                        <x-admin.icon name="folder" class="h-4 w-4" x-show="icon(file) === 'folder'" />
                        <x-admin.icon name="image" class="h-4 w-4" x-show="icon(file) === 'image'" />
                        <x-admin.icon name="box" class="h-4 w-4" x-show="icon(file) === 'box'" />
                    </span>
                    <span class="min-w-0 flex-1 truncate text-sm text-neutral-700" x-text="file.name"></span>
                    <span class="w-16 shrink-0 text-right text-xs text-neutral-400" x-text="file.size"></span>
                    <span class="w-24 shrink-0 text-right text-xs text-neutral-400" x-text="file.updated_at"></span>
                </li>
            </template>
        </ul>
    </div>
</div>
