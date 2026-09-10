@props(['threshold' => 300])

<div x-data="{ show: false }" @scroll.window="show = window.scrollY > {{ (int) $threshold }}">
    <button
        type="button"
        x-show="show"
        x-transition
        x-cloak
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        {{ $attributes->class(['fixed bottom-6 right-6 z-40 flex h-11 w-11 items-center justify-center rounded-full bg-white text-neutral-600 shadow-lg ring-1 ring-neutral-200 hover:bg-neutral-50']) }}
    >
        <span class="sr-only">{{ __('Lên đầu trang') }}</span>
        <x-admin.icon name="chevron-up" class="h-5 w-5" />
    </button>
</div>
