@props([
    'title' => null,
    'message',
    'confirmLabel' => null,
    'cancelLabel' => null,
    'action' => null,
    'method' => 'POST',
])

@php
    $confirmLabel ??= __('Đồng ý');
    $cancelLabel ??= __('Huỷ');
@endphp

<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    class="relative inline-flex"
>
    <span x-ref="trigger" @click="open = ! open">
        {{ $trigger }}
    </span>

    <div
        x-anchor.bottom-start.offset.8="$refs.trigger"
        x-show="open"
        x-transition.duration.100ms
        x-cloak
        class="z-40 w-64 rounded-md bg-white p-4 shadow-lg ring-1 ring-black/5"
    >
        <div class="flex items-start gap-x-2">
            <x-admin.icon name="exclamation-triangle" class="h-5 w-5 shrink-0 text-warning-500" />
            <div>
                @if($title)
                    <p class="text-sm font-semibold text-neutral-900">{{ $title }}</p>
                @endif
                <p class="text-sm text-neutral-600">{{ $message }}</p>
            </div>
        </div>

        <div class="mt-3 flex justify-end gap-x-2">
            <x-admin.button type="button" size="sm" variant="ghost" @click="open = false">
                {{ $cancelLabel }}
            </x-admin.button>

            @if($action)
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if(strtoupper($method) !== 'POST')
                        @method($method)
                    @endif
                    <x-admin.button type="submit" size="sm" variant="danger">{{ $confirmLabel }}</x-admin.button>
                </form>
            @else
                <x-admin.button type="button" size="sm" variant="danger" @click="open = false; $dispatch('popconfirm-confirmed')">
                    {{ $confirmLabel }}
                </x-admin.button>
            @endif
        </div>
    </div>
</div>
