@props([
    'data' => [],
    'color' => 'primary',
    'height' => 160,
    'area' => true,
])

@php
    $strokeClasses = [
        'primary' => 'stroke-primary-600',
        'success' => 'stroke-success-600',
        'danger' => 'stroke-danger-600',
        'warning' => 'stroke-warning-600',
        'info' => 'stroke-info-600',
        'neutral' => 'stroke-neutral-600',
    ][$color] ?? 'stroke-primary-600';

    $fillClasses = [
        'primary' => 'fill-primary-500/10',
        'success' => 'fill-success-500/10',
        'danger' => 'fill-danger-500/10',
        'warning' => 'fill-warning-500/10',
        'info' => 'fill-info-500/10',
        'neutral' => 'fill-neutral-500/10',
    ][$color] ?? 'fill-primary-500/10';

    $dotClasses = [
        'primary' => 'fill-primary-600',
        'success' => 'fill-success-600',
        'danger' => 'fill-danger-600',
        'warning' => 'fill-warning-600',
        'info' => 'fill-info-600',
        'neutral' => 'fill-neutral-600',
    ][$color] ?? 'fill-primary-600';

    $width = 400;
    $values = array_map(fn ($point) => (float) ($point['value'] ?? 0), $data);
    $count = count($values);
    $max = $count ? max($values) : 0;
    $min = $count ? min($values) : 0;
    $range = ($max - $min) ?: 1;

    $points = [];
    foreach ($values as $index => $value) {
        $x = $count > 1 ? ($index / ($count - 1)) * $width : $width / 2;
        $y = 8 + ($height - 16) - ((($value - $min) / $range) * ($height - 16));
        $points[] = ['x' => round($x, 2), 'y' => round($y, 2), 'value' => $value, 'label' => $data[$index]['label'] ?? ''];
    }

    $polyline = collect($points)->map(fn ($p) => "{$p['x']},{$p['y']}")->implode(' ');
    $areaPath = $points
        ? 'M0,'.$height.' L'.collect($points)->map(fn ($p) => "{$p['x']},{$p['y']}")->implode(' L')." L{$width},{$height} Z"
        : '';
@endphp

<div {{ $attributes }}>
    @if(empty($data))
        <x-admin.empty-state icon="chart-bar" :title="__('Chưa có dữ liệu')" class="py-8" />
    @else
        <svg viewBox="0 0 {{ $width }} {{ $height }}" preserveAspectRatio="none" class="w-full" style="height: {{ $height }}px" role="img" aria-label="{{ __('Biểu đồ đường') }}">
            @if($area)
                <path d="{{ $areaPath }}" class="{{ $fillClasses }}" stroke="none" />
            @endif
            <polyline points="{{ $polyline }}" fill="none" class="{{ $strokeClasses }}" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round" />
            @foreach($points as $point)
                <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="3" class="{{ $dotClasses }}" stroke="white" stroke-width="1.5">
                    <title>{{ $point['label'] }}: {{ $point['value'] }}</title>
                </circle>
            @endforeach
        </svg>

        <div class="mt-2 flex justify-between text-xs text-neutral-400">
            @foreach($data as $point)
                <span>{{ $point['label'] ?? '' }}</span>
            @endforeach
        </div>
    @endif
</div>
