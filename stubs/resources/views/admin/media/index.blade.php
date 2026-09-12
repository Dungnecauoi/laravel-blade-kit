<x-layouts.admin :title="__('Media')">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item current>{{ __('Media') }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    <div
        x-data="mediaLibrary({
            items: '{{ route('admin.media.items') }}',
            uploadMultiple: '{{ route('admin.media.upload-multiple') }}',
            bulkDelete: '{{ route('admin.media.bulk-delete') }}',
            itemDestroy: '{{ route('admin.media.items.destroy', ':id') }}',
            foldersTree: '{{ route('admin.media.folders.tree') }}',
            foldersStore: '{{ route('admin.media.folders.store') }}',
        })"
        class="grid grid-cols-1 gap-6 lg:grid-cols-4"
    >
        {{-- Folder sidebar --}}
        <x-admin.card :padding="false" class="lg:col-span-1">
            <div class="flex items-center justify-between border-b border-neutral-200 p-3">
                <span class="text-sm font-semibold text-neutral-900">{{ __('Thư mục') }}</span>
                <button type="button" @click="createFolder()" class="text-neutral-400 hover:text-primary-600" :title="i18n.newFolderName">
                    <x-admin.icon name="plus" class="h-4 w-4" />
                </button>
            </div>

            <nav class="max-h-96 overflow-y-auto p-2">
                <button
                    type="button"
                    @click="openFolder(null)"
                    :class="currentFolderId === null ? 'bg-primary-50 text-primary-700' : 'text-neutral-600 hover:bg-neutral-50'"
                    class="flex w-full items-center gap-2 rounded-md px-2 py-1.5 text-left text-sm"
                >
                    <x-admin.icon name="folder" class="h-4 w-4 shrink-0" />
                    {{ __('Tất cả') }}
                </button>

                <template x-for="folder in folders" :key="folder.id">
                    <button
                        type="button"
                        @click="openFolder(folder.id)"
                        :style="{ paddingLeft: (folder.depth * 16 + 8) + 'px' }"
                        :class="currentFolderId === folder.id ? 'bg-primary-50 text-primary-700' : 'text-neutral-600 hover:bg-neutral-50'"
                        class="flex w-full items-center gap-2 rounded-md py-1.5 pr-2 text-left text-sm"
                    >
                        <x-admin.icon name="folder" class="h-4 w-4 shrink-0" />
                        <span class="truncate" x-text="folder.name"></span>
                        <span class="ml-auto shrink-0 text-xs text-neutral-400" x-text="folder.media_count"></span>
                    </button>
                </template>
            </nav>
        </x-admin.card>

        {{-- Main area --}}
        <x-admin.card :padding="false" class="lg:col-span-3">
            <div class="flex flex-wrap items-center gap-3 border-b border-neutral-200 p-4">
                <div class="relative min-w-[200px] flex-1">
                    {{-- Plain input, not <x-admin.search-input> — that component owns its
                         own internal x-data/x-model for its clear button, which would
                         collide with binding it to this page's own `search` state. --}}
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <x-admin.icon name="search" class="h-4 w-4 text-neutral-400" />
                    </span>
                    <input
                        type="search"
                        x-model="search"
                        @input.debounce.400ms="fetchItems()"
                        placeholder="{{ __('Tìm kiếm...') }}"
                        class="block w-full rounded-md border-0 py-2.5 pl-9 pr-3 text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6"
                    />
                </div>

                <x-admin.button x-show="selected.length > 0" x-cloak variant="danger" size="sm" @click="deleteSelected()">
                    {{ __('Xoá') }} (<span x-text="selected.length"></span>)
                </x-admin.button>

                <label class="cursor-pointer">
                    <input type="file" multiple class="hidden" @change="upload($event.target.files); $event.target.value = ''">
                    <span class="inline-flex items-center gap-1.5 rounded-md bg-primary-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-primary-500">
                        <x-admin.icon name="upload" class="h-4 w-4" />
                        {{ __('Tải lên') }}
                    </span>
                </label>
            </div>

            {{-- Drop zone --}}
            <div
                @dragover.prevent="dragging = true"
                @dragleave.prevent="dragging = false"
                @drop.prevent="dragging = false; upload($event.dataTransfer.files)"
                :class="dragging ? 'border-primary-400 bg-primary-50' : 'border-transparent'"
                class="border-2 border-dashed p-4 transition-colors"
            >
                <template x-if="uploading">
                    <div class="mb-3 flex items-center gap-2 text-sm text-neutral-500">
                        <x-admin.spinner class="h-4 w-4" />
                        {{ __('Đang tải lên...') }}
                    </div>
                </template>

                <template x-if="loading">
                    <div class="py-12 text-center text-sm text-neutral-400">{{ __('Đang tải...') }}</div>
                </template>

                <template x-if="! loading && items.length === 0">
                    <x-admin.empty-state icon="image" :title="__('Chưa có file nào')" :description="__('hoặc kéo thả file vào đây')" />
                </template>

                <div x-show="! loading && items.length > 0" class="grid grid-cols-2 gap-4 sm:grid-cols-3 xl:grid-cols-4">
                    <template x-for="item in items" :key="item.id">
                        <div class="group relative overflow-hidden rounded-lg border border-neutral-200">
                            <label class="absolute left-2 top-2 z-10">
                                <input
                                    type="checkbox"
                                    :checked="selected.includes(item.id)"
                                    @change="toggleSelect(item.id)"
                                    class="h-4 w-4 rounded border-neutral-300 text-primary-600 focus:ring-primary-600"
                                >
                            </label>

                            <button
                                type="button"
                                @click="deleteItem(item.id)"
                                class="absolute right-2 top-2 z-10 hidden rounded-full bg-white/90 p-1 text-danger-600 group-hover:block"
                            >
                                <x-admin.icon name="trash" class="h-3.5 w-3.5" />
                            </button>

                            <div class="flex aspect-square items-center justify-center bg-neutral-100">
                                <template x-if="isImage(item)">
                                    <img :src="item.url" :alt="item.alt_text ?? item.original_filename" class="h-full w-full object-cover">
                                </template>
                                <template x-if="! isImage(item)">
                                    <x-admin.icon name="folder" class="h-8 w-8 text-neutral-400" />
                                </template>
                            </div>

                            <div class="p-2">
                                <p class="truncate text-xs text-neutral-700" x-text="item.original_filename"></p>
                                <p class="text-xs text-neutral-400" x-text="item.human_size"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div x-show="meta.last_page > 1" class="flex items-center justify-between border-t border-neutral-200 p-4 text-sm">
                <span class="text-neutral-500"><span x-text="meta.total"></span> {{ __('kết quả') }}</span>
                <div class="flex gap-2">
                    <x-admin.button size="sm" variant="secondary" x-bind:disabled="meta.current_page <= 1" @click="fetchItems(meta.current_page - 1)">{{ __('Trước') }}</x-admin.button>
                    <x-admin.button size="sm" variant="secondary" x-bind:disabled="meta.current_page >= meta.last_page" @click="fetchItems(meta.current_page + 1)">{{ __('Sau') }}</x-admin.button>
                </div>
            </div>
        </x-admin.card>
    </div>
</x-layouts.admin>
