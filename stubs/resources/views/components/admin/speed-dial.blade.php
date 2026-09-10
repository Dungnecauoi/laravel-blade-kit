@props(['icon' => 'plus'])

<div x-data="{ open: false }" @click.outside="open = false" @keydown.escape="open = false" class="fixed bottom-6 right-6 z-40">
    <div x-show="open" x-transition x-cloak class="mb-3 flex flex-col items-end gap-y-2">
        {{ $slot }}
    </div>

    <button
        type="button"
        @click="open = ! open"
        :aria-expanded="open.toString()"
        class="flex h-14 w-14 items-center justify-center rounded-full bg-primary-600 text-white shadow-lg hover:bg-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-300"
    >
        <span class="sr-only">{{ __('Mở menu thao tác nhanh') }}</span>
        <x-admin.icon :name="$icon" class="h-6 w-6 transition-transform duration-200" x-bind:class="{ 'rotate-45': open }" />
    </button>
</div>
