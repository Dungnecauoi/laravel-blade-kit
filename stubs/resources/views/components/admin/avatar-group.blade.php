@props(['avatars' => [], 'max' => 4, 'size' => 'sm'])

@php
    $visible = array_slice($avatars, 0, $max);
    $remaining = max(0, count($avatars) - $max);
    $sizeClass = ['sm' => 'h-8 w-8 text-xs', 'md' => 'h-10 w-10 text-sm', 'lg' => 'h-12 w-12 text-base'][$size] ?? 'h-8 w-8 text-xs';
@endphp

<div {{ $attributes->class(['flex -space-x-2']) }}>
    @foreach($visible as $item)
        <x-admin.avatar :name="$item['name'] ?? null" :src="$item['src'] ?? null" :size="$size" class="ring-2 ring-white" />
    @endforeach

    @if($remaining > 0)
        <span class="{{ $sizeClass }} inline-flex items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-500 ring-2 ring-white">
            +{{ $remaining }}
        </span>
    @endif
</div>
