@props(['data' => [], 'color' => 'primary', 'height' => 160, 'area' => true])

<div {{ $attributes }}>
    @if(empty($data))
        <x-admin.empty-state icon="chart-bar" :title="__('Chưa có dữ liệu')" class="py-8" />
    @else
        <canvas
            x-data="lineChart(@js(collect($data)->pluck('label')), @js(collect($data)->pluck('value')), @js($color), @js($area))"
            role="img"
            aria-label="{{ __('Biểu đồ đường') }}"
            style="height: {{ $height }}px; width: 100%;"
        ></canvas>
    @endif
</div>
