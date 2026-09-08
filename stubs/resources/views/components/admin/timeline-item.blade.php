@props(['title', 'time' => null, 'icon' => 'check', 'color' => 'primary'])

@php
    $dot = [
        'primary' => 'bg-primary-600',
        'success' => 'bg-success-600',
        'danger' => 'bg-danger-600',
        'warning' => 'bg-warning-600',
        'neutral' => 'bg-neutral-400',
    ][$color] ?? 'bg-primary-600';
@endphp

<li class="relative flex gap-x-4 pb-6 last:pb-0 [&:last-child>.timeline-line]:hidden">
    <div class="timeline-line absolute bottom-0 left-3.5 top-8 w-px bg-neutral-200"></div>

    <span class="relative flex h-7 w-7 shrink-0 items-center justify-center rounded-full {{ $dot }} text-white">
        <x-admin.icon :name="$icon" class="h-4 w-4" />
    </span>

    <div class="flex-1 pt-0.5">
        <p class="text-sm font-medium text-neutral-900">{{ $title }}</p>
        @if($time)
            <p class="text-xs text-neutral-400">{{ $time }}</p>
        @endif
        @if(trim($slot))
            <div class="mt-1 text-sm text-neutral-600">{{ $slot }}</div>
        @endif
    </div>
</li>
