@props(['commands' => []])

<div
    x-data="{
        open: false,
        query: '',
        activeIndex: 0,
        commands: @js(collect($commands)->map(fn ($c) => ['label' => $c['label'], 'url' => $c['url']])->values()),
        get filtered() {
            return this.query === ''
                ? this.commands
                : this.commands.filter((c) => c.label.toLowerCase().includes(this.query.toLowerCase()));
        },
        launch() {
            this.open = true;
            this.query = '';
            this.activeIndex = 0;
            this.$nextTick(() => this.$refs.search.focus());
        },
        select(command) {
            if (command) window.location.href = command.url;
            this.open = false;
        },
    }"
    @open-command-palette.window="launch()"
    @keydown.window="if (($event.metaKey || $event.ctrlKey) && $event.key.toLowerCase() === 'k') { $event.preventDefault(); launch(); }"
    @keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="relative z-[100]"
>
    <div class="fixed inset-0 bg-neutral-900/50" x-show="open" x-transition.opacity @click="open = false"></div>

    <div class="fixed inset-0 overflow-y-auto p-4 sm:p-6 md:p-20">
        <div
            @click.outside="open = false"
            x-show="open"
            x-transition
            class="mx-auto max-w-xl overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black/5"
        >
            <div class="flex items-center gap-x-3 border-b border-neutral-100 px-4">
                <x-admin.icon name="search" class="h-5 w-5 text-neutral-400" />
                <input
                    type="text"
                    x-ref="search"
                    x-model="query"
                    @input="activeIndex = 0"
                    @keydown.arrow-down.prevent="activeIndex = Math.min(activeIndex + 1, filtered.length - 1)"
                    @keydown.arrow-up.prevent="activeIndex = Math.max(activeIndex - 1, 0)"
                    @keydown.enter.prevent="select(filtered[activeIndex])"
                    placeholder="{{ __('Tìm kiếm trang, hành động...') }}"
                    class="w-full border-0 py-4 text-sm text-neutral-900 placeholder:text-neutral-400 focus:outline-none focus:ring-0"
                    autocomplete="off"
                >
                <x-admin.kbd class="hidden shrink-0 sm:block">Esc</x-admin.kbd>
            </div>

            <ul class="max-h-80 overflow-y-auto py-2">
                <template x-for="(command, index) in filtered" :key="command.label">
                    <li>
                        <button
                            type="button"
                            @click="select(command)"
                            @mouseenter="activeIndex = index"
                            :class="activeIndex === index ? 'bg-primary-50 text-primary-700' : 'text-neutral-700'"
                            class="flex w-full items-center gap-x-3 px-4 py-2.5 text-left text-sm"
                        >
                            <x-admin.icon name="chevron-right" class="h-4 w-4 opacity-40" />
                            <span x-text="command.label"></span>
                        </button>
                    </li>
                </template>

                <li x-show="filtered.length === 0" class="px-4 py-6 text-center text-sm text-neutral-400">
                    {{ __('Không tìm thấy kết quả.') }}
                </li>
            </ul>

            <div class="hidden items-center gap-x-4 border-t border-neutral-100 px-4 py-2 text-xs text-neutral-400 sm:flex">
                <span class="flex items-center gap-x-1">
                    <x-admin.kbd>&uarr;</x-admin.kbd>
                    <x-admin.kbd>&darr;</x-admin.kbd>
                    {{ __('di chuyển') }}
                </span>
                <span class="flex items-center gap-x-1">
                    <x-admin.kbd>Enter</x-admin.kbd>
                    {{ __('chọn') }}
                </span>
                <span class="flex items-center gap-x-1">
                    <x-admin.kbd>Esc</x-admin.kbd>
                    {{ __('đóng') }}
                </span>
            </div>
        </div>
    </div>
</div>
