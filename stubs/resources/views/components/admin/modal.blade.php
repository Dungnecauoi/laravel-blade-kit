@props(['id', 'title' => null, 'maxWidth' => 'md'])

@php
    $maxWidthClass = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth] ?? 'sm:max-w-md';
@endphp

<div
    x-data="{ open: false }"
    x-show="open"
    x-cloak
    @open-modal.window="if ($event.detail === '{{ $id }}') open = true"
    @close-modal.window="if ($event.detail === '{{ $id }}') open = false"
    @keydown.escape.window="open = false"
    class="relative z-50"
>
    <div class="fixed inset-0 bg-neutral-900/50" x-show="open" x-transition.opacity></div>

    <div class="fixed inset-0 z-50 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                @click.outside="open = false"
                x-show="open"
                x-transition
                {{ $attributes->class(["w-full rounded-xl bg-white shadow-xl {$maxWidthClass}"]) }}
            >
                @if($title)
                    <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-4">
                        <h3 class="text-base font-semibold text-neutral-900">{{ $title }}</h3>
                        <button
                            type="button"
                            @click="open = false"
                            class="-mr-2 inline-flex h-9 w-9 items-center justify-center rounded-md text-neutral-400 hover:bg-neutral-100 hover:text-neutral-600"
                        >
                            <span class="sr-only">{{ __('Đóng') }}</span>
                            <x-admin.icon name="x-mark" class="h-5 w-5" />
                        </button>
                    </div>
                @endif

                <div class="p-5">
                    {{ $slot }}
                </div>

                @isset($footer)
                    <div class="flex justify-end gap-x-3 border-t border-neutral-200 px-5 py-4">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
