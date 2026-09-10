<x-layouts.guest :title="__('Trang chủ')">
    <x-slot:nav>
        <a href="#features" class="text-sm font-medium text-neutral-600 hover:text-neutral-900">{{ __('Tính năng') }}</a>
        <a href="#pricing" class="text-sm font-medium text-neutral-600 hover:text-neutral-900">{{ __('Bảng giá') }}</a>
        <a href="#testimonials" class="text-sm font-medium text-neutral-600 hover:text-neutral-900">{{ __('Đánh giá') }}</a>
    </x-slot:nav>

    <x-slot:cta>
        <x-admin.button variant="secondary" size="sm" :href="route('auth-demo.login')">{{ __('Đăng nhập') }}</x-admin.button>
        <x-admin.button variant="primary" size="sm" :href="route('auth-demo.register')">{{ __('Dùng thử miễn phí') }}</x-admin.button>
    </x-slot:cta>

    <x-admin.hero
        :eyebrow="__('Ra mắt bản v2.0')"
        :title="__('Quản trị hệ thống nhanh hơn, gọn hơn, ít phiền hơn')"
        :description="__('Bộ công cụ quản trị dựng sẵn trên Laravel Blade + Alpine.js — cài một lần, sở hữu toàn bộ mã nguồn, không phụ thuộc dịch vụ ngoài.')"
    >
        <x-slot:actions>
            <x-admin.button variant="primary" size="lg" :href="route('auth-demo.register')">{{ __('Bắt đầu miễn phí') }}</x-admin.button>
            <x-admin.button variant="secondary" size="lg" href="#pricing">{{ __('Xem bảng giá') }}</x-admin.button>
        </x-slot:actions>
    </x-admin.hero>

    <div class="mx-auto max-w-5xl px-4 pb-20 sm:px-6 lg:px-8">
        <x-admin.stats-strip :stats="[
            ['value' => '10K+', 'label' => __('Doanh nghiệp tin dùng')],
            ['value' => '99.9%', 'label' => __('Thời gian hoạt động')],
            ['value' => '90+', 'label' => __('Component dựng sẵn')],
            ['value' => '24/7', 'label' => __('Hỗ trợ kỹ thuật')],
        ]" />
    </div>

    <div id="features" class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-neutral-900">{{ __('Mọi thứ bạn cần cho một trang quản trị') }}</h2>
            <p class="mt-4 text-neutral-500">{{ __('Hơn 90 component dựng sẵn, từ form đến biểu đồ, từ kanban đến hoá đơn.') }}</p>
        </div>

        <x-admin.feature-grid class="mt-16">
            <x-admin.feature-item icon="puzzle" :title="__('90+ component')">
                {{ __('Từ input, bảng dữ liệu đến kanban, biểu đồ, permission matrix — đủ cho một hệ thống quản trị thật.') }}
            </x-admin.feature-item>
            <x-admin.feature-item icon="settings" :title="__('Tuỳ biến hoàn toàn')">
                {{ __('Không phụ thuộc vendor — mọi component là file Blade thật trong project của bạn, sửa thoải mái.') }}
            </x-admin.feature-item>
            <x-admin.feature-item icon="check-circle" :title="__('Sẵn sàng production')">
                {{ __('Đầy đủ i18n, dark/light sidebar, responsive, kiểm thử kỹ trước khi phát hành.') }}
            </x-admin.feature-item>
        </x-admin.feature-grid>
    </div>

    <div id="pricing" class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-neutral-900">{{ __('Bảng giá đơn giản') }}</h2>
            <p class="mt-4 text-neutral-500">{{ __('Miễn phí mã nguồn mở — trả phí chỉ khi cần hỗ trợ ưu tiên.') }}</p>
        </div>

        <div class="mx-auto mt-16 grid max-w-5xl grid-cols-1 gap-8 lg:grid-cols-3">
            <x-admin.pricing-plan
                :name="__('Miễn phí')"
                price="0₫"
                :description="__('Cho dự án cá nhân')"
                :features="[__('Toàn bộ component'), __('Cập nhật cộng đồng'), __('Giấy phép MIT')]"
            />
            <x-admin.pricing-plan
                :name="__('Chuyên nghiệp')"
                price="990.000₫"
                period="{{ __('năm') }}"
                :description="__('Cho đội nhóm nhỏ')"
                :highlighted="true"
                :features="[__('Mọi thứ ở gói Miễn phí'), __('Hỗ trợ qua email'), __('Cập nhật ưu tiên')]"
            />
            <x-admin.pricing-plan
                :name="__('Doanh nghiệp')"
                price="{{ __('Liên hệ') }}"
                :description="__('Cho tổ chức lớn')"
                :features="[__('Mọi thứ ở gói Chuyên nghiệp'), __('Hỗ trợ trực tiếp'), __('Tư vấn triển khai')]"
            />
        </div>
    </div>

    <div id="testimonials" class="mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-neutral-900">{{ __('Được tin dùng bởi nhiều đội ngũ') }}</h2>
        </div>

        <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2">
            <x-admin.testimonial
                :quote="__('Tiết kiệm cho team mình cả tuần dựng UI — mọi thứ đã sẵn sàng, chỉ việc nối dữ liệu thật vào.')"
                name="Nguyễn Văn An"
                :role="__('CTO, Ánh Dương')"
            />
            <x-admin.testimonial
                :quote="__('Thích nhất là không bị khoá vào một package đóng — cần sửa gì cứ mở file Blade ra sửa.')"
                name="Trần Thị Bình"
                :role="__('Lead Frontend, Core Admin')"
            />
        </div>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-20 sm:px-6 lg:px-8">
        <x-admin.cta-section
            :title="__('Sẵn sàng bắt đầu?')"
            :description="__('Cài đặt trong vài phút, có ngay trang quản trị đầy đủ.')"
        >
            <x-slot:actions>
                <x-admin.button variant="secondary" size="lg" :href="route('auth-demo.register')">{{ __('Dùng thử miễn phí') }}</x-admin.button>
            </x-slot:actions>
        </x-admin.cta-section>
    </div>

    <x-admin.footer :columns="[
        __('Sản phẩm') => [__('Tính năng') => '#features', __('Bảng giá') => '#pricing'],
        __('Công ty') => [__('Về chúng tôi') => '#', __('Liên hệ') => '#'],
        __('Pháp lý') => [__('Điều khoản') => '#', __('Bảo mật') => '#'],
    ]" :description="__('Bộ công cụ quản trị mã nguồn mở dựng trên Laravel.')" />
</x-layouts.guest>
