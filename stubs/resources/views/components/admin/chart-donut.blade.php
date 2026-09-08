@props([
    'data' => [],
    'size' => 160,
    'label' => null,
])

@php
    $strokeClasses = [
        'primary' => 'stroke-primary-600',
        'success' => 'stroke-success-600',
        'danger' => 'stroke-danger-600',
        'warning' => 'stroke-warning-600',
        'info' => 'stroke-info-600',
        'neutral' => 'stroke-neutral-400',
    ];

    $dotClasses = [
        'primary' => 'bg-primary-600',
        'success' => 'bg-success-600',
        'danger' => 'bg-danger-600',
        'warning' => 'bg-warning-600',
        'info' => 'bg-info-600',
        'neutral' => 'bg-neutral-400',
    ];

    $total = collect($data)->sum('value');
    $radius = 15.9155;
    $cumulative = 0;

    $segments = collect($data)->map(function ($segment) use (&$cumulative, $total) {
        $percent = $total > 0 ? ($segment['value'] / $total) * 100 : 0;
        $offset = 25 - $cumulative;
        $cumulative += $percent;

        return [...$segment, 'percent' => $percent, 'offset' => $offset];
    });
@endphp

<div {{ $attributes->class(['flex items-center gap-6']) }}>
    @if(empty($data) || $total <= 0)
        <x-admin.empty-state icon="chart-bar" :title="__('Chưa có dữ liệu')" class="py-8" />
    @else
        <div class="relative shrink-0" style="width: {{ $size }}px; height: {{ $size }}px">
            <svg viewBox="0 0 36 36" class="-rotate-90" role="img" aria-label="{{ __('Biểu đồ tròn') }}">
                <circle cx="18" cy="18" r="{{ $radius }}" fill="none" class="stroke-neutral-100" stroke-width="3.2" />
                @foreach($segments as $segment)
                    <circle
                        cx="18" cy="18" r="{{ $radius }}" fill="none"
                        class="{{ $strokeClasses[$segment['color'] ?? 'neutral'] ?? $strokeClasses['neutral'] }}"
                        stroke-width="3.2"
                        stroke-dasharray="{{ $segment['percent'] }} {{ 100 - $segment['percent'] }}"
                        stroke-dashoffset="{{ $segment['offset'] }}"
                        stroke-linecap="round"
                    >
                        <title>{{ $segment['label'] }}: {{ $segment['value'] }}</title>
                    </circle>
                @endforeach
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-xl font-semibold text-neutral-900">{{ $label ?? $total }}</span>
                @if($label)
                    <span class="text-xs text-neutral-400">{{ $total }}</span>
                @endif
            </div>
        </div>

        <ul class="space-y-2">
            @foreach($data as $segment)
                <li class="flex items-center gap-x-2 text-sm">
                    <span class="h-2.5 w-2.5 rounded-full {{ $dotClasses[$segment['color'] ?? 'neutral'] ?? $dotClasses['neutral'] }}"></span>
                    <span class="text-neutral-600">{{ $segment['label'] }}</span>
                    <span class="font-medium text-neutral-900">{{ $segment['value'] }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
