@php
    $order = [
        'number' => 'ORD-1082',
        'placed_at' => '08/09/2026 09:12',
        'customer' => ['name' => 'Nguyễn Văn An', 'email' => 'an.nguyen@example.com', 'phone' => '0901 234 567'],
        'shipping_address' => '12 Nguyễn Huệ, Phường Bến Nghé, Q.1, TP.HCM',
    ];

    $steps = [
        ['label' => __('Đã đặt hàng'), 'at' => '08/09/2026 09:12'],
        ['label' => __('Đã xác nhận'), 'at' => '08/09/2026 09:40'],
        ['label' => __('Đang giao hàng'), 'at' => '08/09/2026 14:05'],
        ['label' => __('Đã giao thành công')],
    ];

    $items = [
        ['name' => __('Áo thun basic — trắng, size M'), 'qty' => 2, 'price' => 199000],
        ['name' => __('Quần jean slimfit — xanh, size 30'), 'qty' => 1, 'price' => 459000],
    ];
@endphp

<x-layouts.admin :title="__('Đơn hàng').' #'.$order['number']">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item :href="route('admin.dashboard')">{{ __('Tổng quan') }}</x-admin.breadcrumb-item>
        <x-admin.breadcrumb-item current>{{ __('Đơn hàng') }} #{{ $order['number'] }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <x-admin.card :title="__('Trạng thái đơn hàng')" :subtitle="__('Đặt lúc').' '.$order['placed_at']">
                <x-admin.order-timeline :steps="$steps" :current="3" />
            </x-admin.card>

            <x-admin.card :title="__('Sản phẩm')" :padding="false">
                <x-admin.order-summary :items="$items" :shipping="30000" :tax="0" class="rounded-none ring-0" />
            </x-admin.card>
        </div>

        <div class="space-y-6">
            <x-admin.card :title="__('Khách hàng')">
                <x-admin.description-list>
                    <x-admin.description-item :label="__('Họ tên')">{{ $order['customer']['name'] }}</x-admin.description-item>
                    <x-admin.description-item label="Email">{{ $order['customer']['email'] }}</x-admin.description-item>
                    <x-admin.description-item :label="__('Điện thoại')">{{ $order['customer']['phone'] }}</x-admin.description-item>
                    <x-admin.description-item :label="__('Địa chỉ giao hàng')">{{ $order['shipping_address'] }}</x-admin.description-item>
                </x-admin.description-list>
            </x-admin.card>

            <x-admin.card :title="__('Thanh toán')">
                <x-admin.payment-method-badge method="cod" />
            </x-admin.card>
        </div>
    </div>
</x-layouts.admin>
