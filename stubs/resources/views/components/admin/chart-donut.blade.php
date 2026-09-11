@props(['data' => [], 'size' => 160, 'label' => null])

@php
    $total = collect($data)->sum('value');
@endphp

<div {{ $attributes->class(['flex items-center gap-6']) }}>
    @if(empty($data) || $total <= 0)
        <x-admin.empty-state icon="chart-bar" :title="__('Chưa có dữ liệu')" class="py-8" />
    @else
        <div class="relative shrink-0" style="width: {{ $size }}px; height: {{ $size }}px">
            <canvas
                x-data="donutChart(@js(collect($data)->pluck('label')), @js(collect($data)->pluck('value')), @js(collect($data)->pluck('color')))"
                role="img"
                aria-label="{{ __('Biểu đồ tròn') }}"
            ></canvas>
            <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-xl font-semibold text-neutral-900">{{ $label ?? $total }}</span>
                @if($label)
                    <span class="text-xs text-neutral-400">{{ $total }}</span>
                @endif
            </div>
        </div>

        <ul class="space-y-2">
            @foreach($data as $segment)
                <li class="flex items-center gap-x-2 text-sm">
                    <span class="h-2.5 w-2.5 shrink-0 rounded-full" style="background-color: var(--color-{{ $segment['color'] ?? 'neutral' }}-500)"></span>
                    <span class="text-neutral-600">{{ $segment['label'] }}</span>
                    <span class="font-medium text-neutral-900">{{ $segment['value'] }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
