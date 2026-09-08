@props(['images' => []])

@php
    $normalized = collect($images)->map(fn ($image) => is_array($image) ? $image : ['url' => $image, 'alt' => ''])->values();
@endphp

<div x-data="{ active: 0, images: @js($normalized) }" {{ $attributes }}>
    <div class="relative aspect-square overflow-hidden rounded-xl bg-neutral-100 ring-1 ring-neutral-200">
        <template x-if="images.length === 0">
            <div class="flex h-full w-full items-center justify-center text-neutral-300">
                <x-admin.icon name="image" class="h-10 w-10" />
            </div>
        </template>
        <template x-for="(image, index) in images" :key="index">
            <img :src="image.url" :alt="image.alt" x-show="active === index" class="h-full w-full object-cover">
        </template>
    </div>

    <div class="mt-3 grid grid-cols-5 gap-2" x-show="images.length > 1">
        <template x-for="(image, index) in images" :key="index">
            <button
                type="button"
                @click="active = index"
                :class="active === index ? 'ring-2 ring-primary-600' : 'ring-1 ring-neutral-200 hover:ring-neutral-300'"
                class="aspect-square overflow-hidden rounded-lg focus:outline-none"
            >
                <img :src="image.url" :alt="image.alt" class="h-full w-full object-cover">
            </button>
        </template>
    </div>
</div>
