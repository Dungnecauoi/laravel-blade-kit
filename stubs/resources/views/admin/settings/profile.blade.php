<x-admin.card :title="__('Thông tin hồ sơ')" :subtitle="__('Cập nhật thông tin cá nhân của bạn')">
    <form action="#" method="POST" class="space-y-5">
        @csrf

        <x-admin.avatar-upload name="avatar" :label="__('Đổi ảnh đại diện')" />

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <x-admin.input name="settings_name" :label="__('Họ và tên')" value="Nguyễn Văn An" />
            <x-admin.input type="email" name="settings_email" label="Email" value="an.nguyen@example.com" />
        </div>

        <x-admin.tag-input name="skills" :label="__('Kỹ năng')" :value="['Laravel', 'Tailwind CSS', 'Alpine.js']" :hint="__('Nhập rồi bấm Enter để thêm')" />

        <div class="flex justify-end">
            <x-admin.button type="submit" variant="primary">{{ __('Lưu thay đổi') }}</x-admin.button>
        </div>
    </form>
</x-admin.card>
