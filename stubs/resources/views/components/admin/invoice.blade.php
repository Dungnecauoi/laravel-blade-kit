@props([
    'number' => null,
    'date' => null,
    'dueDate' => null,
    'status' => null,
    'from' => [],
    'to' => [],
    'items' => [],
    'notes' => null,
    'taxRate' => 0,
    'discount' => 0,
    'shipping' => 0,
    'currency' => '₫',
])

@php
    $subtotal = collect($items)->sum(fn ($item) => ($item['qty'] ?? 1) * ($item['price'] ?? 0));
    $tax = $subtotal * ($taxRate / 100);
    $total = $subtotal + $tax + $shipping - $discount;
    $format = fn ($amount) => number_format($amount, 0, ',', '.').' '.$currency;
@endphp

<div {{ $attributes->class(['rounded-xl bg-white p-8 shadow-sm ring-1 ring-neutral-200 print:shadow-none print:ring-0']) }}>
    <div class="flex items-start justify-between gap-6">
        <div>
            @isset($logo)
                <div class="mb-3">{{ $logo }}</div>
            @endisset
            <p class="text-lg font-semibold text-neutral-900">{{ $from['name'] ?? config('admin.name') }}</p>
            @if(! empty($from['address']))<p class="text-sm text-neutral-500">{{ $from['address'] }}</p>@endif
            @if(! empty($from['email']))<p class="text-sm text-neutral-500">{{ $from['email'] }}</p>@endif
            @if(! empty($from['phone']))<p class="text-sm text-neutral-500">{{ $from['phone'] }}</p>@endif
        </div>

        <div class="text-right">
            <h2 class="text-2xl font-bold text-neutral-900">{{ __('Hoá đơn') }}</h2>
            <p class="mt-1 text-sm text-neutral-500">#{{ $number }}</p>
            @if($status)
                <div class="mt-2">
                    <x-admin.badge :color="$status === 'paid' ? 'success' : ($status === 'overdue' ? 'danger' : 'warning')">
                        {{ match ($status) {
                            'paid' => __('Đã thanh toán'),
                            'overdue' => __('Quá hạn'),
                            default => __('Chờ thanh toán'),
                        } }}
                    </x-admin.badge>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-8 grid grid-cols-2 gap-6 border-t border-neutral-100 pt-6">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-400">{{ __('Gửi đến') }}</p>
            <p class="mt-1 text-sm font-medium text-neutral-900">{{ $to['name'] ?? '' }}</p>
            @if(! empty($to['address']))<p class="text-sm text-neutral-500">{{ $to['address'] }}</p>@endif
            @if(! empty($to['email']))<p class="text-sm text-neutral-500">{{ $to['email'] }}</p>@endif
        </div>
        <div class="text-right">
            <p class="text-sm text-neutral-500">{{ __('Ngày lập') }}: <span class="font-medium text-neutral-900">{{ $date }}</span></p>
            @if($dueDate)
                <p class="mt-1 text-sm text-neutral-500">{{ __('Hạn thanh toán') }}: <span class="font-medium text-neutral-900">{{ $dueDate }}</span></p>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <x-admin.table :headers="[__('Mô tả'), __('SL'), __('Đơn giá'), __('Thành tiền')]">
            @foreach($items as $item)
                <tr>
                    <td class="px-4 py-3 text-sm text-neutral-900">{{ $item['description'] }}</td>
                    <td class="px-4 py-3 text-sm text-neutral-500">{{ $item['qty'] ?? 1 }}</td>
                    <td class="px-4 py-3 text-sm text-neutral-500">{{ $format($item['price'] ?? 0) }}</td>
                    <td class="px-4 py-3 text-right text-sm font-medium text-neutral-900">{{ $format(($item['qty'] ?? 1) * ($item['price'] ?? 0)) }}</td>
                </tr>
            @endforeach
        </x-admin.table>
    </div>

    <div class="mt-6 flex justify-end">
        <div class="w-full max-w-xs space-y-2 text-sm">
            <div class="flex justify-between text-neutral-500">
                <span>{{ __('Tạm tính') }}</span><span>{{ $format($subtotal) }}</span>
            </div>
            @if($taxRate > 0)
                <div class="flex justify-between text-neutral-500">
                    <span>{{ __('Thuế') }} ({{ $taxRate }}%)</span><span>{{ $format($tax) }}</span>
                </div>
            @endif
            @if($shipping > 0)
                <div class="flex justify-between text-neutral-500">
                    <span>{{ __('Phí vận chuyển') }}</span><span>{{ $format($shipping) }}</span>
                </div>
            @endif
            @if($discount > 0)
                <div class="flex justify-between text-neutral-500">
                    <span>{{ __('Giảm giá') }}</span><span>-{{ $format($discount) }}</span>
                </div>
            @endif
            <div class="flex justify-between border-t border-neutral-200 pt-2 text-base font-semibold text-neutral-900">
                <span>{{ __('Tổng cộng') }}</span><span>{{ $format($total) }}</span>
            </div>
        </div>
    </div>

    @if($notes)
        <div class="mt-6 border-t border-neutral-100 pt-4 text-sm text-neutral-500">{{ $notes }}</div>
    @endif

    <div class="mt-8 flex justify-end print:hidden">
        <x-admin.button type="button" variant="secondary" onclick="window.print()">
            <x-admin.icon name="printer" class="h-4 w-4" />
            {{ __('In hoá đơn') }}
        </x-admin.button>
    </div>
</div>
