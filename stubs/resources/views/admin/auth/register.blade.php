<x-layouts.auth :title="__('Tạo tài khoản')">
    <x-slot:footer>
        {{ __('Đã có tài khoản?') }}
        <a href="{{ route('auth-demo.login') }}" class="font-medium text-primary-600 hover:text-primary-500">{{ __('Đăng nhập') }}</a>
    </x-slot:footer>

    <form action="#" method="POST" class="space-y-5">
        @csrf

        <x-admin.input name="name" :label="__('Họ và tên')" placeholder="Nguyễn Văn A" required autofocus />
        <x-admin.input type="email" name="email" :label="__('Email')" placeholder="ban@vidu.com" required />
        <x-admin.input type="password" name="password" :label="__('Mật khẩu')" placeholder="••••••••" :hint="__('Tối thiểu 8 ký tự')" required />
        <x-admin.input type="password" name="password_confirmation" :label="__('Xác nhận mật khẩu')" placeholder="••••••••" required />

        <x-admin.checkbox name="terms" required>
            {{ __('Tôi đồng ý với') }}
            <a href="#" class="font-medium text-primary-600 hover:text-primary-500">{{ __('điều khoản dịch vụ') }}</a>
        </x-admin.checkbox>

        <x-admin.button type="submit" variant="primary" class="w-full justify-center">
            {{ __('Tạo tài khoản') }}
        </x-admin.button>
    </form>
</x-layouts.auth>
