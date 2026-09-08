@props(['price' => 0, 'compareAt' => null, 'currency' => '₫'])

@php
    $format = fn ($amount) => number_format($amount, 0, ',', '.').' '.$currency;
    $hasDiscount = $compareAt && $compareAt > $price;
    $percentOff = $hasDiscount ? round((($compareAt - $price) / $compareAt) * 100) : 0;
@endphp

<div {{ $attributes->class(['flex items-center gap-x-2']) }}>
    <span class="text-base font-semibold text-neutral-900">{{ $format($price) }}</span>
    @if($hasDiscount)
        <span class="text-sm text-neutral-400 line-through">{{ $format($compareAt) }}</span>
        <x-admin.badge color="danger">-{{ $percentOff }}%</x-admin.badge>
    @endif
</div>
