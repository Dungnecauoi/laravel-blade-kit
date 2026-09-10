@props(['average', 'total', 'breakdown' => []])

@php
    $max = collect($breakdown)->max() ?: 1;
@endphp

<div {{ $attributes->class(['flex flex-col gap-8 sm:flex-row sm:items-center']) }}>
    <div class="shrink-0 text-center">
        <p class="text-4xl font-bold text-neutral-900">{{ number_format($average, 1) }}</p>
        <div class="mt-1 flex items-center justify-center gap-x-0.5">
            @for($i = 1; $i <= 5; $i++)
                <x-admin.icon name="star" class="h-4 w-4 {{ $i <= round($average) ? 'text-warning-400' : 'text-neutral-200' }}" fill="currentColor" />
            @endfor
        </div>
        <p class="mt-1 text-sm text-neutral-400">{{ __(':count đánh giá', ['count' => number_format($total)]) }}</p>
    </div>

    <div class="flex-1 space-y-2">
        @for($star = 5; $star >= 1; $star--)
            @php
                $count = $breakdown[$star] ?? 0;
                $percent = $max > 0 ? ($count / $max) * 100 : 0;
            @endphp
            <div class="flex items-center gap-x-3 text-sm">
                <span class="w-10 shrink-0 text-neutral-500">{{ $star }} {{ __('sao') }}</span>
                <div class="h-2 flex-1 overflow-hidden rounded-full bg-neutral-100">
                    <div class="h-full rounded-full bg-warning-400" style="width: {{ $percent }}%"></div>
                </div>
                <span class="w-10 shrink-0 text-right text-neutral-400">{{ $count }}</span>
            </div>
        @endfor
    </div>
</div>
