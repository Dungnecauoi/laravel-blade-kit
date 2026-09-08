@props([
    'data' => [],
    'color' => 'primary',
    'height' => 160,
])

@php
    $barClasses = [
        'primary' => 'bg-primary-500 hover:bg-primary-600',
        'success' => 'bg-success-500 hover:bg-success-600',
        'danger' => 'bg-danger-500 hover:bg-danger-600',
        'warning' => 'bg-warning-500 hover:bg-warning-600',
        'info' => 'bg-info-500 hover:bg-info-600',
        'neutral' => 'bg-neutral-500 hover:bg-neutral-600',
    ][$color] ?? 'bg-primary-500 hover:bg-primary-600';

    $max = collect($data)->max('value') ?: 1;
@endphp

<div {{ $attributes }}>
    @if(empty($data))
        <x-admin.empty-state icon="chart-bar" :title="__('Chưa có dữ liệu')" class="py-8" />
    @else
        <div class="flex items-end gap-2" style="height: {{ $height }}px">
            @foreach($data as $bar)
                @php $percent = $max > 0 ? max((($bar['value'] ?? 0) / $max) * 100, 2) : 2; @endphp
                <div class="flex h-full flex-1 flex-col items-center justify-end gap-y-1.5">
                    <span class="text-xs font-medium text-neutral-500">{{ $bar['value'] ?? 0 }}</span>
                    <div
                        class="w-full rounded-t-md transition-all duration-300 {{ $barClasses }}"
                        style="height: {{ $percent }}%"
                        title="{{ ($bar['label'] ?? '').': '.($bar['value'] ?? 0) }}"
                    ></div>
                </div>
            @endforeach
        </div>

        <div class="mt-2 flex gap-2 text-xs text-neutral-400">
            @foreach($data as $bar)
                <span class="flex-1 truncate text-center">{{ $bar['label'] ?? '' }}</span>
            @endforeach
        </div>
    @endif
</div>
