@props(['value' => 0, 'max' => 100, 'color' => 'primary', 'label' => null])

@php
    $percent = $max > 0 ? min(100, max(0, ($value / $max) * 100)) : 0;

    $barColor = [
        'primary' => 'bg-primary-600',
        'success' => 'bg-success-600',
        'warning' => 'bg-warning-600',
        'danger' => 'bg-danger-600',
        'info' => 'bg-info-600',
    ][$color] ?? 'bg-primary-600';
@endphp

<div {{ $attributes }}>
    @if($label)
        <div class="mb-1 flex items-center justify-between text-sm">
            <span class="text-neutral-600">{{ $label }}</span>
            <span class="text-neutral-400">{{ round($percent) }}%</span>
        </div>
    @endif

    <div class="h-2 w-full overflow-hidden rounded-full bg-neutral-100">
        <div class="h-full rounded-full {{ $barColor }} transition-all duration-300" style="width: {{ $percent }}%"></div>
    </div>
</div>
