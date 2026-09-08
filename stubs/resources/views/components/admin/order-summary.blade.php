@props(['items' => [], 'shipping' => 0, 'discount' => 0, 'tax' => 0, 'currency' => '₫'])

@php
    $format = fn ($amount) => number_format($amount, 0, ',', '.').' '.$currency;
    $subtotal = collect($items)->sum(fn ($item) => ($item['qty'] ?? 1) * ($item['price'] ?? 0));
    $total = $subtotal + $shipping + $tax - $discount;
@endphp

<div {{ $attributes->class(['rounded-xl bg-white ring-1 ring-neutral-200']) }}>
    <ul class="divide-y divide-neutral-100 px-5">
        @foreach($items as $item)
            <li class="flex items-center justify-between gap-4 py-3">
                <div class="flex min-w-0 items-center gap-x-3">
                    @if(! empty($item['image']))
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-12 w-12 shrink-0 rounded-md object-cover ring-1 ring-neutral-200">
                    @endif
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-neutral-900">{{ $item['name'] }}</p>
                        <p class="text-xs text-neutral-400">{{ __('SL') }}: {{ $item['qty'] ?? 1 }}</p>
                    </div>
                </div>
                <span class="shrink-0 text-sm font-medium text-neutral-900">{{ $format(($item['qty'] ?? 1) * ($item['price'] ?? 0)) }}</span>
            </li>
        @endforeach
    </ul>

    <div class="space-y-2 border-t border-neutral-100 px-5 py-4 text-sm">
        <div class="flex justify-between text-neutral-500"><span>{{ __('Tạm tính') }}</span><span>{{ $format($subtotal) }}</span></div>
        @if($shipping > 0)
            <div class="flex justify-between text-neutral-500"><span>{{ __('Phí vận chuyển') }}</span><span>{{ $format($shipping) }}</span></div>
        @endif
        @if($tax > 0)
            <div class="flex justify-between text-neutral-500"><span>{{ __('Thuế') }}</span><span>{{ $format($tax) }}</span></div>
        @endif
        @if($discount > 0)
            <div class="flex justify-between text-neutral-500"><span>{{ __('Giảm giá') }}</span><span>-{{ $format($discount) }}</span></div>
        @endif
    </div>

    <div class="flex justify-between rounded-b-xl border-t border-neutral-200 bg-neutral-50 px-5 py-3 text-base font-semibold text-neutral-900">
        <span>{{ __('Tổng cộng') }}</span><span>{{ $format($total) }}</span>
    </div>
</div>
