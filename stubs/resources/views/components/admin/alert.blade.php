@props(['type' => 'info', 'title' => null, 'dismissible' => false])

@php
    $palette = [
        'info' => ['icon' => 'information-circle', 'classes' => 'bg-info-50 text-info-700 ring-info-200', 'iconClass' => 'text-info-500'],
        'success' => ['icon' => 'check-circle', 'classes' => 'bg-success-50 text-success-700 ring-success-200', 'iconClass' => 'text-success-500'],
        'warning' => ['icon' => 'exclamation-triangle', 'classes' => 'bg-warning-50 text-warning-700 ring-warning-200', 'iconClass' => 'text-warning-500'],
        'error' => ['icon' => 'x-circle', 'classes' => 'bg-danger-50 text-danger-700 ring-danger-200', 'iconClass' => 'text-danger-500'],
    ];

    $styles = $palette[$type] ?? $palette['info'];
@endphp

<div
    @if($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif
    {{ $attributes->class(["flex items-start gap-x-3 rounded-lg p-4 text-sm ring-1 ring-inset {$styles['classes']}"]) }}
>
    <x-admin.icon :name="$styles['icon']" class="mt-0.5 h-5 w-5 shrink-0 {{ $styles['iconClass'] }}" />

    <div class="flex-1">
        @if($title)
            <p class="font-medium">{{ $title }}</p>
        @endif
        <div class="{{ $title ? 'mt-1' : '' }}">{{ $slot }}</div>
    </div>

    @if($dismissible)
        <button type="button" @click="show = false" class="shrink-0 text-current opacity-60 hover:opacity-100">
            <span class="sr-only">{{ __('Đóng') }}</span>
            <x-admin.icon name="x-mark" class="h-4 w-4" />
        </button>
    @endif
</div>
