@props(['method' => 'cod'])

@php
    $config = [
        'cod' => ['icon' => 'truck', 'label' => __('Thanh toán khi nhận hàng')],
        'bank_transfer' => ['icon' => 'wallet', 'label' => __('Chuyển khoản ngân hàng')],
        'card' => ['icon' => 'credit-card', 'label' => __('Thẻ tín dụng/ghi nợ')],
        'e_wallet' => ['icon' => 'wallet', 'label' => __('Ví điện tử')],
    ][$method] ?? ['icon' => 'wallet', 'label' => __('Khác')];
@endphp

<span {{ $attributes->class(['inline-flex items-center gap-x-1.5 rounded-full bg-neutral-100 px-2.5 py-1 text-xs font-medium text-neutral-600']) }}>
    <x-admin.icon :name="$config['icon']" class="h-3.5 w-3.5" />
    {{ $config['label'] }}
</span>
