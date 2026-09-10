@props(['dismissible' => true, 'icon' => 'information-circle'])

<div
    @if($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif
    {{ $attributes->class(['flex flex-wrap items-center justify-between gap-3 border-b border-neutral-200 bg-neutral-50 px-4 py-3']) }}
>
    <div class="flex items-center gap-x-2.5 text-sm text-neutral-700">
        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-neutral-200">
            <x-admin.icon :name="$icon" class="h-3.5 w-3.5 text-neutral-600" />
        </span>
        <span>{{ $slot }}</span>
    </div>

    <div class="flex items-center gap-x-3">
        @isset($action)
            {{ $action }}
        @endisset

        @if($dismissible)
            <button type="button" @click="show = false" class="flex h-7 w-7 shrink-0 items-center justify-center rounded text-neutral-400 hover:bg-neutral-200 hover:text-neutral-600">
                <span class="sr-only">{{ __('Đóng') }}</span>
                <x-admin.icon name="x-mark" class="h-4 w-4" />
            </button>
        @endif
    </div>
</div>
