@props(['images' => [], 'interval' => 5000, 'autoplay' => true])

@php
    $normalized = collect($images)->map(fn ($image) => is_array($image) ? $image : ['url' => $image, 'alt' => ''])->values();
@endphp

<div
    x-data="{
        index: 0,
        images: @js($normalized),
        timer: null,
        next() { this.index = (this.index + 1) % this.images.length; },
        prev() { this.index = (this.index - 1 + this.images.length) % this.images.length; },
        start() { if (! @js($autoplay) || this.images.length <= 1) return; this.timer = setInterval(() => this.next(), {{ (int) $interval }}); },
        stop() { clearInterval(this.timer); },
        destroy() { clearInterval(this.timer); },
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
    {{ $attributes->class(['relative w-full overflow-hidden rounded-xl']) }}
>
    <div class="relative h-56 md:h-96">
        <template x-for="(image, i) in images" :key="i">
            <img
                :src="image.url"
                :alt="image.alt"
                x-show="index === i"
                x-transition.opacity.duration.500ms
                class="absolute inset-0 h-full w-full object-cover"
            >
        </template>
    </div>

    <div class="absolute inset-x-0 bottom-4 z-10 flex justify-center gap-2" x-show="images.length > 1">
        <template x-for="(image, i) in images" :key="i">
            <button
                type="button"
                @click="index = i"
                :class="index === i ? 'bg-white' : 'bg-white/50'"
                class="h-2 w-2 rounded-full transition-colors"
                :aria-label="`Slide ${i + 1}`"
            ></button>
        </template>
    </div>

    <button type="button" @click="prev()" x-show="images.length > 1" class="absolute inset-y-0 left-0 z-10 flex items-center px-3">
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/30 text-white hover:bg-white/50">
            <span class="sr-only">{{ __('Trước') }}</span>
            <x-admin.icon name="chevron-right" class="h-4 w-4 rotate-180" />
        </span>
    </button>

    <button type="button" @click="next()" x-show="images.length > 1" class="absolute inset-y-0 right-0 z-10 flex items-center px-3">
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/30 text-white hover:bg-white/50">
            <span class="sr-only">{{ __('Sau') }}</span>
            <x-admin.icon name="chevron-right" class="h-4 w-4" />
        </span>
    </button>
</div>
