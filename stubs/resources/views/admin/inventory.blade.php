@php
    $items = [
        ['sku' => 'AO-THUN-001', 'name' => __('Áo thun basic'), 'warehouse' => __('Kho HCM'), 'quantity' => 128, 'threshold' => 20],
        ['sku' => 'QUAN-JEAN-002', 'name' => __('Quần jean slimfit'), 'warehouse' => __('Kho HCM'), 'quantity' => 14, 'threshold' => 20],
        ['sku' => 'GIAY-SNK-003', 'name' => __('Giày sneaker trắng'), 'warehouse' => __('Kho HN'), 'quantity' => 0, 'threshold' => 10],
        ['sku' => 'TUI-XT-004', 'name' => __('Túi xách tote'), 'warehouse' => __('Kho HN'), 'quantity' => 46, 'threshold' => 15],
        ['sku' => 'MU-LEN-005', 'name' => __('Mũ len'), 'warehouse' => __('Kho HCM'), 'quantity' => 8, 'threshold' => 10],
    ];

    $history = [
        ['type' => 'in', 'quantity' => 100, 'note' => __('Nhập từ nhà cung cấp Ánh Dương'), 'at' => '08/09/2026 09:12'],
        ['type' => 'out', 'quantity' => 24, 'note' => __('Xuất cho đơn hàng #ORD-1082'), 'at' => '08/09/2026 11:40'],
        ['type' => 'out', 'quantity' => 6, 'note' => __('Xuất cho đơn hàng #ORD-1084'), 'at' => '07/09/2026 16:05'],
        ['type' => 'in', 'quantity' => 50, 'note' => __('Nhập bổ sung'), 'at' => '05/09/2026 08:30'],
    ];
@endphp

<x-layouts.admin :title="__('Kho hàng')">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item :href="route('admin.dashboard')">{{ __('Tổng quan') }}</x-admin.breadcrumb-item>
        <x-admin.breadcrumb-item current>{{ __('Kho hàng') }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <x-admin.card :title="__('Tồn kho theo sản phẩm')" :subtitle="__('Theo dõi số lượng tồn kho trên từng chi nhánh')" :padding="false">
                <x-admin.inventory-table :items="$items" class="rounded-none ring-0" />
            </x-admin.card>
        </div>

        <x-admin.card :title="__('Lịch sử nhập/xuất kho')">
            <x-admin.stock-history :entries="$history" />
        </x-admin.card>
    </div>
</x-layouts.admin>
