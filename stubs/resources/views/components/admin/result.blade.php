@props(['status' => 'success', 'title', 'description' => null])

@php
    $config = [
        'success' => ['icon' => 'check-circle', 'class' => 'text-success-500'],
        'error' => ['icon' => 'x-circle', 'class' => 'text-danger-500'],
        'warning' => ['icon' => 'exclamation-triangle', 'class' => 'text-warning-500'],
        'info' => ['icon' => 'information-circle', 'class' => 'text-info-500'],
    ][$status] ?? ['icon' => 'check-circle', 'class' => 'text-success-500'];
@endphp

<div {{ $attributes->class(['flex flex-col items-center px-4 py-16 text-center']) }}>
    <x-admin.icon :name="$config['icon']" class="h-16 w-16 {{ $config['class'] }}" />

    <h2 class="mt-6 text-xl font-semibold text-neutral-900">{{ $title }}</h2>

    @if($description)
        <p class="mt-2 max-w-md text-sm text-neutral-500">{{ $description }}</p>
    @endif

    @isset($extra)
        <div class="mt-6 w-full max-w-md rounded-lg bg-neutral-50 p-4 text-left text-sm">
            {{ $extra }}
        </div>
    @endisset

    @isset($actions)
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            {{ $actions }}
        </div>
    @endisset
</div>
