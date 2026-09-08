<x-layouts.auth :title="__('Đăng nhập')">
    <x-slot:footer>
        {{ __('Chưa có tài khoản?') }}
        <a href="{{ route('auth-demo.register') }}" class="font-medium text-primary-600 hover:text-primary-500">{{ __('Đăng ký ngay') }}</a>
    </x-slot:footer>

    <form action="#" method="POST" class="space-y-5">
        @csrf

        <x-admin.input type="email" name="email" :label="__('Email')" placeholder="ban@vidu.com" required autofocus />

        <div>
            <x-admin.input type="password" name="password" :label="__('Mật khẩu')" placeholder="••••••••" required />
            <div class="mt-2 text-right">
                <a href="{{ route('auth-demo.forgot-password') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    {{ __('Quên mật khẩu?') }}
                </a>
            </div>
        </div>

        <x-admin.checkbox name="remember" :label="__('Ghi nhớ đăng nhập')" />

        <x-admin.button type="submit" variant="primary" class="w-full justify-center">
            {{ __('Đăng nhập') }}
        </x-admin.button>
    </form>
</x-layouts.auth>
