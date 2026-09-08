<x-layouts.blank :title="__('Hoá đơn')" max-width="3xl">
    <x-admin.invoice
        number="INV-2026-0148"
        date="08/09/2026"
        due-date="22/09/2026"
        status="pending"
        :from="['name' => config('admin.name'), 'address' => '12 Nguyễn Huệ, Q.1, TP.HCM', 'email' => 'billing@example.com']"
        :to="['name' => 'Công ty TNHH Ánh Dương', 'address' => '45 Lê Lợi, Q.1, TP.HCM', 'email' => 'ketoan@anhduong.vn']"
        :items="[
            ['description' => __('Gói dịch vụ Pro — 1 năm'), 'qty' => 1, 'price' => 4800000],
            ['description' => __('Tên miền .vn — gia hạn'), 'qty' => 1, 'price' => 750000],
            ['description' => __('Hỗ trợ triển khai'), 'qty' => 3, 'price' => 500000],
        ]"
        :tax-rate="8"
        :shipping="0"
        :discount="200000"
        :notes="__('Vui lòng thanh toán trước hạn để tránh gián đoạn dịch vụ. Cảm ơn quý khách!')"
    />
</x-layouts.blank>
