<x-admin.card :title="__('Giao diện')" :subtitle="__('Tuỳ chỉnh màu thương hiệu và chế độ hiển thị')">
    <div class="max-w-sm space-y-5">
        <x-admin.color-picker name="accent_color" :label="__('Màu thương hiệu')" value="#4f46e5" />
        <x-admin.toggle name="dark_mode" :label="__('Chế độ tối')" />
    </div>
</x-admin.card>
