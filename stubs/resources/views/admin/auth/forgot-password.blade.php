<x-layouts.auth :title="__('Quên mật khẩu')">
    <x-slot:footer>
        <a href="{{ route('auth-demo.login') }}" class="font-medium text-primary-600 hover:text-primary-500">
            {{ __('Quay lại đăng nhập') }}
        </a>
    </x-slot:footer>

    <p class="mb-5 text-sm text-neutral-500">
        {{ __('Nhập email của bạn, chúng tôi sẽ gửi liên kết đặt lại mật khẩu.') }}
    </p>

    <form action="#" method="POST" class="space-y-5">
        @csrf

        <x-admin.input type="email" name="email" :label="__('Email')" placeholder="ban@vidu.com" required autofocus />

        <x-admin.button type="submit" variant="primary" class="w-full justify-center">
            {{ __('Gửi liên kết đặt lại mật khẩu') }}
        </x-admin.button>
    </form>
</x-layouts.auth>
