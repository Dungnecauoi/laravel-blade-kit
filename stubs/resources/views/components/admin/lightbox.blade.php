@props(['images' => []])

@php
    $normalized = collect($images)->map(fn ($image) => is_array($image) ? $image : ['url' => $image, 'alt' => ''])->values();
@endphp

<div
    x-data="{
        open: false,
        index: 0,
        images: @js($normalized),
        show(i) { this.index = i; this.open = true; },
        next() { this.index = (this.index + 1) % this.images.length; },
        prev() { this.index = (this.index - 1 + this.images.length) % this.images.length; },
    }"
>
    <div {{ $attributes->class(['grid grid-cols-3 gap-2 sm:grid-cols-4']) }}>
        <template x-for="(image, i) in images" :key="i">
            <button type="button" @click="show(i)" class="aspect-square overflow-hidden rounded-lg ring-1 ring-neutral-200 hover:opacity-90">
                <img :src="image.url" :alt="image.alt" class="h-full w-full object-cover">
            </button>
        </template>
    </div>

    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        @click="open = false"
        @keydown.escape.window="open = false"
        @keydown.arrow-right.window="next()"
        @keydown.arrow-left.window="prev()"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-neutral-900/90 p-4"
    >
        <button type="button" @click.stop="open = false" class="absolute right-4 top-4 flex h-10 w-10 items-center justify-center rounded-full text-white hover:bg-white/10">
            <span class="sr-only">{{ __('Đóng') }}</span>
            <x-admin.icon name="x-mark" class="h-6 w-6" />
        </button>

        <button type="button" @click.stop="prev()" x-show="images.length > 1" class="absolute left-4 flex h-10 w-10 items-center justify-center rounded-full text-white hover:bg-white/10">
            <span class="sr-only">{{ __('Trước') }}</span>
            <x-admin.icon name="chevron-right" class="h-6 w-6 rotate-180" />
        </button>

        <img @click.stop :src="images[index]?.url" :alt="images[index]?.alt" class="max-h-full max-w-full rounded-lg object-contain">

        <button type="button" @click.stop="next()" x-show="images.length > 1" class="absolute right-4 flex h-10 w-10 items-center justify-center rounded-full text-white hover:bg-white/10">
            <span class="sr-only">{{ __('Sau') }}</span>
            <x-admin.icon name="chevron-right" class="h-6 w-6" />
        </button>

        <p x-show="images.length > 1" class="absolute bottom-4 text-sm text-white/70" x-text="`${index + 1} / ${images.length}`"></p>
    </div>
</div>
