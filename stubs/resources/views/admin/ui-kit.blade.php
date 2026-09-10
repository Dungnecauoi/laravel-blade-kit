<x-layouts.admin :title="__('UI Kit')">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item :href="route('admin.dashboard')">{{ __('Tổng quan') }}</x-admin.breadcrumb-item>
        <x-admin.breadcrumb-item current>{{ __('UI Kit') }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    {{-- Layouts --}}
    <x-admin.card title="Layouts" :subtitle="__('Mỗi layout là một trang riêng — mở để xem toàn màn hình')">
        <div class="flex flex-wrap gap-2">
            <x-admin.button variant="secondary" size="sm" :href="route('auth-demo.login')" target="_blank">x-layouts.auth — {{ __('Đăng nhập') }}</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('auth-demo.register')" target="_blank">x-layouts.auth — {{ __('Đăng ký') }}</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('auth-demo.forgot-password')" target="_blank">x-layouts.auth — {{ __('Quên mật khẩu') }}</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('errors-demo.404')" target="_blank">x-layouts.error — 404</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('errors-demo.403')" target="_blank">x-layouts.error — 403</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('errors-demo.500')" target="_blank">x-layouts.error — 500</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('admin.invoice')" target="_blank">x-layouts.blank — {{ __('Hoá đơn') }}</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('admin.settings')" target="_blank">{{ __('Trang Cài đặt') }}</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('admin.inventory')" target="_blank">{{ __('Trang Kho hàng') }}</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('admin.orders.show')" target="_blank">{{ __('Trang Đơn hàng') }}</x-admin.button>
            <x-admin.button variant="secondary" size="sm" :href="route('landing')" target="_blank">x-layouts.guest — {{ __('Trang chủ') }}</x-admin.button>
        </div>
    </x-admin.card>

    {{-- Buttons --}}
    <x-admin.card title="Buttons" :subtitle="__('Các biến thể và kích thước của x-admin.button')">
        <div class="flex flex-wrap items-center gap-3">
            <x-admin.button variant="primary">Primary</x-admin.button>
            <x-admin.button variant="secondary">Secondary</x-admin.button>
            <x-admin.button variant="outline">Outline</x-admin.button>
            <x-admin.button variant="danger">Danger</x-admin.button>
            <x-admin.button variant="ghost">Ghost</x-admin.button>
            <x-admin.button variant="primary" loading>{{ __('Đang lưu') }}</x-admin.button>
            <x-admin.button variant="secondary" disabled>{{ __('Disabled') }}</x-admin.button>
            <x-admin.button variant="primary" :href="route('admin.dashboard')">{{ __('Link button') }}</x-admin.button>
        </div>
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <x-admin.button size="sm">{{ __('Small') }}</x-admin.button>
            <x-admin.button size="md">{{ __('Medium') }}</x-admin.button>
            <x-admin.button size="lg">{{ __('Large') }}</x-admin.button>
        </div>
    </x-admin.card>

    {{-- Badges & Alerts --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Badges">
            <div class="flex flex-wrap gap-2">
                <x-admin.badge color="neutral">Neutral</x-admin.badge>
                <x-admin.badge color="primary">Primary</x-admin.badge>
                <x-admin.badge color="danger">Danger</x-admin.badge>
                <x-admin.badge color="warning">Warning</x-admin.badge>
                <x-admin.badge color="success">Success</x-admin.badge>
                <x-admin.badge color="info">Info</x-admin.badge>
            </div>
        </x-admin.card>

        <x-admin.card title="Avatars">
            <div class="flex flex-wrap items-center gap-3">
                <x-admin.avatar name="Nguyễn Văn An" size="sm" />
                <x-admin.avatar name="Trần Thị Bình" size="md" />
                <x-admin.avatar name="Lê Hoàng Cường" size="lg" />
            </div>
        </x-admin.card>
    </div>

    <x-admin.card title="Alerts">
        <div class="space-y-3">
            <x-admin.alert type="info" :title="__('Thông tin')">{{ __('Đây là một thông báo mang tính thông tin.') }}</x-admin.alert>
            <x-admin.alert type="success" :title="__('Thành công')" dismissible>{{ __('Thao tác đã được thực hiện thành công.') }}</x-admin.alert>
            <x-admin.alert type="warning" :title="__('Cảnh báo')" dismissible>{{ __('Vui lòng kiểm tra lại thông tin trước khi tiếp tục.') }}</x-admin.alert>
            <x-admin.alert type="error" :title="__('Lỗi')">{{ __('Đã có lỗi xảy ra, vui lòng thử lại.') }}</x-admin.alert>
        </div>
    </x-admin.card>

    {{-- Forms --}}
    <x-admin.card title="Form controls" subtitle="Input, Select, Textarea, Checkbox, Radio">
        <form class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <x-admin.input name="full_name" :label="__('Họ và tên')" placeholder="Nguyễn Văn A" required />
            <x-admin.input name="email_demo" type="email" label="Email" placeholder="ban@vidu.com" :error="__('Email không hợp lệ.')" />
            <x-admin.select
                name="role_demo"
                :label="__('Vai trò')"
                :placeholder="__('Chọn vai trò')"
                :options="['admin' => __('Quản trị viên'), 'editor' => __('Biên tập viên'), 'member' => __('Thành viên')]"
            />
            <x-admin.input name="phone_demo" :label="__('Số điện thoại')" :hint="__('Định dạng: 0901234567')" />

            <div class="sm:col-span-2">
                <x-admin.textarea name="note_demo" :label="__('Ghi chú')" :placeholder="__('Nhập ghi chú...')" />
            </div>

            <div class="flex flex-col gap-3 sm:col-span-2 sm:flex-row sm:items-center sm:gap-8">
                <x-admin.checkbox name="agree_demo" :label="__('Tôi đồng ý với điều khoản dịch vụ')" />
                <div class="flex items-center gap-4">
                    <x-admin.radio name="plan_demo" value="monthly" :label="__('Hàng tháng')" />
                    <x-admin.radio name="plan_demo" value="yearly" :label="__('Hàng năm')" />
                </div>
            </div>

            <div class="sm:col-span-2">
                <x-admin.button variant="primary" type="submit">{{ __('Lưu thay đổi') }}</x-admin.button>
            </div>
        </form>
    </x-admin.card>

    {{-- Input variants --}}
    <x-admin.card title="Input variants" :subtitle="__('Filled, icon, addon, password, clearable, autosize, number, search, multi-select')">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <x-admin.input name="filled_demo" :label="__('Filled variant')" variant="filled" placeholder="Nguyễn Văn A" />

            <x-admin.input name="icon_demo" :label="__('Icon prefix')" icon="users" placeholder="Tên người dùng" />

            <x-admin.input name="addon_demo" :label="__('Addon')" addon-before="https://" addon-after=".com" placeholder="ten-mien" />

            <x-admin.input name="password_demo" type="password" :label="__('Mật khẩu')" placeholder="••••••••" />

            <x-admin.input name="clearable_demo" :label="__('Clearable')" clearable value="Xoá thử xem" />

            <div>
                <x-admin.label>{{ __('Số lượng') }}</x-admin.label>
                <x-admin.number-input name="quantity_demo" :value="1" min="0" max="99" />
            </div>

            <div class="sm:col-span-2">
                <x-admin.label>{{ __('Tìm kiếm (chuẩn hoá filter bảng)') }}</x-admin.label>
                <x-admin.search-input name="table_search_demo" />
            </div>

            <div class="sm:col-span-2">
                <x-admin.label>{{ __('Ghi chú tự giãn (autosize)') }}</x-admin.label>
                <x-admin.textarea name="autosize_demo" autosize :rows="2" :placeholder="__('Gõ nhiều dòng, khung sẽ tự cao lên...')" />
            </div>

            <div class="sm:col-span-2">
                <x-admin.combobox
                    name="skills_demo"
                    :label="__('Kỹ năng (chọn nhiều)')"
                    :placeholder="__('Chọn kỹ năng')"
                    multiple
                    :options="['php' => 'PHP', 'laravel' => 'Laravel', 'alpine' => 'Alpine.js', 'tailwind' => 'Tailwind CSS', 'vue' => 'Vue.js']"
                />
            </div>
        </div>
    </x-admin.card>

    {{-- Tabs --}}
    <x-admin.card title="Tabs">
        <x-admin.tabs default="profile">
            <x-slot:tabs>
                <x-admin.tab-button value="profile">{{ __('Hồ sơ') }}</x-admin.tab-button>
                <x-admin.tab-button value="security">{{ __('Bảo mật') }}</x-admin.tab-button>
                <x-admin.tab-button value="notifications">{{ __('Thông báo') }}</x-admin.tab-button>
            </x-slot:tabs>

            <x-admin.tab-panel value="profile">
                <p class="text-sm text-neutral-600">{{ __('Cập nhật thông tin hồ sơ cá nhân của bạn tại đây.') }}</p>
            </x-admin.tab-panel>
            <x-admin.tab-panel value="security">
                <p class="text-sm text-neutral-600">{{ __('Quản lý mật khẩu và xác thực hai lớp.') }}</p>
            </x-admin.tab-panel>
            <x-admin.tab-panel value="notifications">
                <p class="text-sm text-neutral-600">{{ __('Tuỳ chỉnh các loại thông báo bạn muốn nhận.') }}</p>
            </x-admin.tab-panel>
        </x-admin.tabs>
    </x-admin.card>

    {{-- Modal & Dropdown --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Modal">
            <p class="mb-4 text-sm text-neutral-600">{{ __('Modal điều khiển bởi sự kiện Alpine toàn cục (open-modal / close-modal).') }}</p>
            <x-admin.button variant="primary" @click="$dispatch('open-modal', 'demo-modal')">{{ __('Mở modal') }}</x-admin.button>
        </x-admin.card>

        <x-admin.card title="Dropdown">
            <p class="mb-4 text-sm text-neutral-600">{{ __('Menu thả xuống, tự đóng khi click ra ngoài.') }}</p>
            <x-admin.dropdown align="left">
                <x-slot:trigger>
                    <x-admin.button variant="secondary">
                        {{ __('Tuỳ chọn') }}
                        <x-admin.icon name="chevron-down" class="h-4 w-4" />
                    </x-admin.button>
                </x-slot:trigger>
                <x-admin.dropdown-link href="#">{{ __('Chỉnh sửa') }}</x-admin.dropdown-link>
                <x-admin.dropdown-link href="#">{{ __('Nhân bản') }}</x-admin.dropdown-link>
                <div class="my-1 border-t border-neutral-100"></div>
                <x-admin.dropdown-link href="#">{{ __('Xoá') }}</x-admin.dropdown-link>
            </x-admin.dropdown>
        </x-admin.card>
    </div>

    <x-admin.modal id="demo-modal" :title="__('Xác nhận hành động')" max-width="md">
        <p class="text-sm text-neutral-600">{{ __('Bạn có chắc chắn muốn thực hiện hành động này không? Hành động này không thể hoàn tác.') }}</p>

        <x-slot:footer>
            <x-admin.button variant="secondary" @click="$dispatch('close-modal', 'demo-modal')">{{ __('Huỷ') }}</x-admin.button>
            <x-admin.button variant="danger" @click="$dispatch('close-modal', 'demo-modal')">{{ __('Xác nhận') }}</x-admin.button>
        </x-slot:footer>
    </x-admin.modal>

    {{-- Table & Pagination --}}
    <x-admin.card title="Table & Pagination" :subtitle="__('Dữ liệu demo được phân trang thật qua LengthAwarePaginator')" :padding="false">
        <x-admin.table :headers="['#', __('Nội dung')]">
            @forelse($demoPaginator as $index => $item)
                <tr>
                    <td class="px-4 py-3 text-neutral-500">{{ $demoPaginator->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-neutral-900">{{ $item }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        <x-admin.empty-state :description="__('Chưa có bản ghi nào để hiển thị.')" />
                    </td>
                </tr>
            @endforelse
        </x-admin.table>

        <x-admin.pagination :paginator="$demoPaginator" />
    </x-admin.card>

    {{-- Empty state --}}
    <x-admin.card title="Empty state">
        <x-admin.empty-state
            icon="folder"
            :title="__('Chưa có dự án nào')"
            :description="__('Bắt đầu bằng cách tạo dự án đầu tiên của bạn.')"
        >
            <x-slot:action>
                <x-admin.button variant="primary">
                    <x-admin.icon name="plus" class="h-4 w-4" />
                    {{ __('Tạo dự án') }}
                </x-admin.button>
            </x-slot:action>
        </x-admin.empty-state>
    </x-admin.card>

    {{-- Toggle & Tooltip --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Toggle">
            <div class="space-y-3">
                <x-admin.toggle name="notify_email_demo" :label="__('Nhận thông báo qua email')" checked />
                <x-admin.toggle name="notify_sms_demo" :label="__('Nhận thông báo qua SMS')" />
            </div>
        </x-admin.card>

        <x-admin.card title="Tooltip">
            <div class="flex items-center gap-x-4">
                <x-admin.tooltip :text="__('Sao chép liên kết')">
                    <x-admin.button variant="secondary" size="sm">{{ __('Di chuột vào đây') }}</x-admin.button>
                </x-admin.tooltip>
                <x-admin.tooltip :text="__('Hiển thị phía dưới')" position="bottom">
                    <x-admin.button variant="ghost" size="sm">{{ __('Bottom') }}</x-admin.button>
                </x-admin.tooltip>
            </div>
        </x-admin.card>
    </div>

    {{-- Combobox --}}
    <x-admin.card title="Combobox" :subtitle="__('Select có tìm kiếm, dùng Alpine, tương thích với old() và form thật')">
        <div class="max-w-sm">
            <x-admin.combobox
                name="country_demo"
                :label="__('Quốc gia')"
                :placeholder="__('Chọn quốc gia')"
                :options="['vn' => 'Việt Nam', 'us' => 'United States', 'jp' => 'Japan', 'sg' => 'Singapore', 'kr' => 'South Korea']"
            />
        </div>
    </x-admin.card>

    {{-- Confirm action --}}
    <x-admin.card title="Confirm action" :subtitle="__('Nút xoá mở modal xác nhận, submit qua form thật (POST + method spoofing)')">
        <x-admin.confirm-action
            id="ui-kit-confirm-demo"
            :action="route('admin.ui-kit')"
            method="DELETE"
            :title="__('Xoá bản ghi này?')"
            :message="__('Đây chỉ là demo — nhấn xác nhận sẽ tải lại trang UI Kit.')"
        />
    </x-admin.card>

    {{-- Sortable + bulk-select table --}}
    <x-admin.card
        title="Sortable & bulk-select table"
        :subtitle="__('Sắp xếp qua query string (?sort=&direction=), chọn nhiều dòng bằng Alpine x-model')"
        :padding="false"
    >
        <div x-data="{ selected: [], allIds: @js(collect($demoRows)->pluck('id')) }">
            <div class="px-5 pt-5" x-show="selected.length > 0" x-cloak>
                <x-admin.bulk-actions-bar>
                    <x-admin.button size="sm" variant="secondary">{{ __('Xuất file') }}</x-admin.button>
                    <x-admin.button size="sm" variant="danger">{{ __('Xoá đã chọn') }}</x-admin.button>
                </x-admin.bulk-actions-bar>
            </div>

            <x-admin.table>
                <x-slot:header>
                    <tr>
                        <th class="w-10 px-4 py-3">
                            <x-admin.checkbox
                                name="select_all_demo"
                                :checked="false"
                                x-bind:checked="selected.length === {{ count($demoRows) }}"
                                @change="selected = $event.target.checked ? allIds : []"
                            />
                        </th>
                        <th class="px-4 py-3"><x-admin.sortable-header field="name" :label="__('Tên')" /></th>
                        <th class="px-4 py-3"><x-admin.sortable-header field="email" label="Email" /></th>
                    </tr>
                </x-slot:header>

                @foreach($demoRows as $row)
                    <tr>
                        <td class="px-4 py-3">
                            <x-admin.checkbox name="rows_demo[]" x-model="selected" :value="$row['id']" />
                        </td>
                        <td class="px-4 py-3 font-medium text-neutral-900">{{ $row['name'] }}</td>
                        <td class="px-4 py-3 text-neutral-500">{{ $row['email'] }}</td>
                    </tr>
                @endforeach
            </x-admin.table>
        </div>
    </x-admin.card>

    {{-- Notification panel --}}
    <x-admin.card title="Notification panel" :subtitle="__('Mặc định rỗng — truyền :notifications thật từ ngoài vào, không tự bịa dữ liệu')">
        <x-admin.notification-panel :notifications="$demoNotifications" />
    </x-admin.card>

    {{-- Skeleton --}}
    <x-admin.card title="Skeleton" :subtitle="__('Placeholder khi đang tải dữ liệu')">
        <div class="flex items-center gap-x-4">
            <x-admin.skeleton circle />
            <div class="flex-1 space-y-2">
                <x-admin.skeleton class="h-4 w-1/3 rounded" />
                <x-admin.skeleton class="h-3 w-2/3 rounded" />
            </div>
        </div>
    </x-admin.card>

    {{-- Progress & Divider --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Progress">
            <div class="space-y-4">
                <x-admin.progress :value="30" :label="__('Đang tải lên')" color="primary" />
                <x-admin.progress :value="70" :label="__('Dung lượng đã dùng')" color="warning" />
                <x-admin.progress :value="100" :label="__('Hoàn tất')" color="success" />
            </div>
        </x-admin.card>

        <x-admin.card title="Divider">
            <p class="text-sm text-neutral-600">{{ __('Nội dung phía trên') }}</p>
            <x-admin.divider />
            <p class="text-sm text-neutral-600">{{ __('Nội dung ở giữa') }}</p>
            <x-admin.divider :label="__('hoặc')" />
            <p class="text-sm text-neutral-600">{{ __('Nội dung phía dưới') }}</p>
        </x-admin.card>
    </div>

    {{-- Accordion --}}
    <x-admin.card title="Accordion" :padding="false">
        <x-admin.accordion default="faq-1">
            <x-admin.accordion-item value="faq-1" :title="__('Core admin này dùng công nghệ gì?')">
                {{ __('Laravel Blade component (cú pháp x-component mới), Tailwind CSS v4 và Alpine.js — không dùng @@extends kiểu cũ.') }}
            </x-admin.accordion-item>
            <x-admin.accordion-item value="faq-2" :title="__('Có cần build JS phức tạp không?')">
                {{ __('Không. Toàn bộ tương tác dùng Alpine.js viết ngay trong Blade, không cần framework JS riêng.') }}
            </x-admin.accordion-item>
            <x-admin.accordion-item value="faq-3" :title="__('Đổi màu thương hiệu ở đâu?')">
                {{ __('Chỉ cần sửa design token trong resources/css/app.css — toàn bộ component tự động ăn theo.') }}
            </x-admin.accordion-item>
        </x-admin.accordion>
    </x-admin.card>

    {{-- Drawer --}}
    <x-admin.card title="Drawer / Slide-over" :subtitle="__('Bảng trượt từ cạnh phải, dùng cho form chỉnh sửa nhanh không rời trang')">
        <x-admin.button variant="primary" @click="$dispatch('open-drawer', 'demo-drawer')">{{ __('Mở drawer') }}</x-admin.button>
    </x-admin.card>

    <x-admin.drawer id="demo-drawer" :title="__('Chỉnh sửa nhanh')">
        <div class="space-y-4">
            <x-admin.input name="drawer_name_demo" :label="__('Tên')" placeholder="Nguyễn Văn A" />
            <x-admin.input name="drawer_email_demo" type="email" label="Email" placeholder="ban@vidu.com" />
            <x-admin.textarea name="drawer_note_demo" :label="__('Ghi chú')" />
        </div>

        <x-slot:footer>
            <x-admin.button variant="secondary" @click="$dispatch('close-drawer', 'demo-drawer')">{{ __('Huỷ') }}</x-admin.button>
            <x-admin.button variant="primary" @click="$dispatch('close-drawer', 'demo-drawer')">{{ __('Lưu thay đổi') }}</x-admin.button>
        </x-slot:footer>
    </x-admin.drawer>

    {{-- File & avatar upload --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="File upload">
            <x-admin.file-upload name="document_demo" :hint="__('PDF, DOCX tối đa 10MB')" accept=".pdf,.doc,.docx" multiple />
        </x-admin.card>

        <x-admin.card title="Avatar upload">
            <x-admin.avatar-upload name="avatar_demo" />
        </x-admin.card>
    </div>

    {{-- AJAX pagination --}}
    <x-admin.card
        title="AJAX pagination"
        :subtitle="__('Alpine + Axios đổi trang không reload — server trả JSON chứa HTML đã render sẵn từ Blade')"
        :padding="false"
    >
        <x-admin.ajax-table :endpoint="route('admin.ui-kit')">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200">
                    <thead class="bg-neutral-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-neutral-500">{{ __('Nội dung') }}</th>
                        </tr>
                    </thead>
                    <tbody x-ref="rows" class="divide-y divide-neutral-100 bg-white">
                        @include('admin.partials.ajax-demo-rows')
                    </tbody>
                </table>
            </div>

            <div x-ref="pagination">
                @include('admin.partials.ajax-demo-pagination')
            </div>
        </x-admin.ajax-table>
    </x-admin.card>

    {{-- Command palette --}}
    <x-admin.card title="Command palette (⌘K)" :subtitle="__('Nhấn Cmd/Ctrl+K ở bất kỳ đâu, hoặc bấm ô tìm kiếm trên navbar')">
        <x-admin.button variant="secondary" @click="$dispatch('open-command-palette')">
            <x-admin.icon name="search" class="h-4 w-4" />
            {{ __('Mở command palette') }}
        </x-admin.button>
    </x-admin.card>

    {{-- Date picker & Slider --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Date picker">
            <div class="max-w-xs">
                <x-admin.date-picker name="date_demo" :label="__('Ngày sinh')" />
            </div>
        </x-admin.card>

        <x-admin.card title="Slider">
            <x-admin.slider name="volume_demo" :label="__('Âm lượng')" :value="40" />
        </x-admin.card>
    </div>

    {{-- Date range picker & Time picker --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Date range picker">
            <x-admin.date-range-picker name="range_demo" :label="__('Khoảng thời gian')" />
        </x-admin.card>

        <x-admin.card title="Time picker">
            <div class="max-w-xs">
                <x-admin.time-picker name="time_demo" :label="__('Giờ mở cửa')" value="09:00" />
            </div>
        </x-admin.card>
    </div>

    {{-- Toggle group & Rating --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Toggle group">
            <x-admin.toggle-group
                name="view_mode_demo"
                value="list"
                :options="['list' => __('Danh sách'), 'grid' => __('Lưới'), 'table' => __('Bảng')]"
            />
        </x-admin.card>

        <x-admin.card title="Rating">
            <div class="flex items-center gap-x-6">
                <x-admin.rating name="rating_demo" :value="3" />
                <x-admin.rating :value="4" readonly />
            </div>
        </x-admin.card>
    </div>

    {{-- Timeline & Stepper --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Timeline">
            <x-admin.timeline>
                <x-admin.timeline-item :title="__('Đơn hàng đã tạo')" time="10:00 - 08/09/2026" icon="plus" color="neutral" />
                <x-admin.timeline-item :title="__('Đã xác nhận thanh toán')" time="10:05 - 08/09/2026" icon="check" color="success" />
                <x-admin.timeline-item :title="__('Đang giao hàng')" time="14:20 - 08/09/2026" icon="upload" color="primary" />
                <x-admin.timeline-item :title="__('Đã giao thành công')" time="—" icon="check" color="neutral" />
            </x-admin.timeline>
        </x-admin.card>

        <x-admin.card title="Stepper">
            <x-admin.stepper
                :steps="[__('Thông tin'), __('Địa chỉ'), __('Thanh toán'), __('Hoàn tất')]"
                :current="2"
            />
        </x-admin.card>
    </div>

    {{-- Description list & List group --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Description list">
            <x-admin.description-list>
                <x-admin.description-item :label="__('Họ và tên')">Nguyễn Văn An</x-admin.description-item>
                <x-admin.description-item label="Email">an.nguyen@example.com</x-admin.description-item>
                <x-admin.description-item :label="__('Vai trò')">
                    <x-admin.badge color="primary">{{ __('Quản trị viên') }}</x-admin.badge>
                </x-admin.description-item>
            </x-admin.description-list>
        </x-admin.card>

        <x-admin.card title="List group" :padding="false">
            <x-admin.list-group>
                <x-admin.list-group-item href="#">
                    <span>{{ __('Cài đặt tài khoản') }}</span>
                    <x-admin.icon name="chevron-right" class="h-4 w-4 text-neutral-400" />
                </x-admin.list-group-item>
                <x-admin.list-group-item href="#">
                    <span>{{ __('Bảo mật') }}</span>
                    <x-admin.icon name="chevron-right" class="h-4 w-4 text-neutral-400" />
                </x-admin.list-group-item>
                <x-admin.list-group-item href="#">
                    <span>{{ __('Thông báo') }}</span>
                    <x-admin.icon name="chevron-right" class="h-4 w-4 text-neutral-400" />
                </x-admin.list-group-item>
            </x-admin.list-group>
        </x-admin.card>
    </div>

    {{-- Avatar group, Copy button, Kbd, Split button --}}
    <x-admin.card title="Avatar group, Copy button, Kbd, Split button">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <p class="mb-2 text-sm text-neutral-500">Avatar group</p>
                <x-admin.avatar-group :avatars="[
                    ['name' => 'Nguyễn Văn An'],
                    ['name' => 'Trần Thị Bình'],
                    ['name' => 'Lê Hoàng Cường'],
                    ['name' => 'Phạm Thu Dung'],
                    ['name' => 'Vũ Minh Đức'],
                ]" :max="3" />
            </div>

            <div>
                <p class="mb-2 text-sm text-neutral-500">Copy button</p>
                <x-admin.copy-button value="sk_live_9f8a7b6c5d4e3f2g1h" />
            </div>

            <div>
                <p class="mb-2 text-sm text-neutral-500">Kbd</p>
                <div class="flex items-center gap-x-1">
                    <x-admin.kbd>Ctrl</x-admin.kbd>
                    <span class="text-neutral-400">+</span>
                    <x-admin.kbd>K</x-admin.kbd>
                </div>
            </div>

            <div>
                <p class="mb-2 text-sm text-neutral-500">Split button</p>
                <x-admin.split-button :label="__('Lưu')" variant="primary">
                    <x-admin.dropdown-link href="#">{{ __('Lưu & tạo mới') }}</x-admin.dropdown-link>
                    <x-admin.dropdown-link href="#">{{ __('Lưu bản nháp') }}</x-admin.dropdown-link>
                </x-admin.split-button>
            </div>
        </div>
    </x-admin.card>

    {{-- Charts --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Chart — line">
            <x-admin.chart-line :data="[
                ['label' => 'T2', 'value' => 12], ['label' => 'T3', 'value' => 19], ['label' => 'T4', 'value' => 14],
                ['label' => 'T5', 'value' => 27], ['label' => 'T6', 'value' => 22], ['label' => 'T7', 'value' => 31], ['label' => 'CN', 'value' => 25],
            ]" />
        </x-admin.card>

        <x-admin.card title="Chart — bar">
            <x-admin.chart-bar color="success" :data="[
                ['label' => 'T1', 'value' => 42], ['label' => 'T2', 'value' => 58], ['label' => 'T3', 'value' => 35],
                ['label' => 'T4', 'value' => 71], ['label' => 'T5', 'value' => 64],
            ]" />
        </x-admin.card>
    </div>

    <x-admin.card title="Chart — donut">
        <x-admin.chart-donut :label="__('Đơn hàng')" :data="[
            ['label' => __('Hoàn tất'), 'value' => 62, 'color' => 'success'],
            ['label' => __('Đang xử lý'), 'value' => 24, 'color' => 'warning'],
            ['label' => __('Đã huỷ'), 'value' => 8, 'color' => 'danger'],
        ]" />
    </x-admin.card>

    {{-- Calendar & Heatmap --}}
    <x-admin.card title="Calendar">
        <x-admin.calendar :events="[
            now()->format('Y-m-d') => [['label' => __('Họp nhóm'), 'color' => 'primary']],
            now()->addDays(2)->format('Y-m-d') => [['label' => __('Hạn báo cáo'), 'color' => 'danger'], ['label' => __('Gọi khách hàng'), 'color' => 'info']],
            now()->addDays(5)->format('Y-m-d') => [['label' => __('Ra mắt tính năng'), 'color' => 'success']],
        ]" />
    </x-admin.card>

    <x-admin.card title="Heatmap" :subtitle="__('Mật độ hoạt động theo ngày, 12 tuần gần nhất')">
        <x-admin.heatmap :weeks="12" :data="collect(range(0, 83))->mapWithKeys(fn ($i) => [now()->subDays($i)->format('Y-m-d') => random_int(0, 9)])->all()" />
    </x-admin.card>

    {{-- Wizard --}}
    <x-admin.card title="Wizard" :subtitle="__('Form nhiều bước, điều hướng bằng Alpine')">
        <form action="#" method="POST">
            @csrf
            <x-admin.wizard :steps="[__('Thông tin'), __('Địa chỉ'), __('Xác nhận')]">
                <x-admin.wizard-step :index="1">
                    <x-admin.input name="wizard_name_demo" :label="__('Họ và tên')" placeholder="Nguyễn Văn A" />
                </x-admin.wizard-step>
                <x-admin.wizard-step :index="2">
                    <x-admin.input name="wizard_address_demo" :label="__('Địa chỉ')" placeholder="12 Nguyễn Huệ, Q.1, TP.HCM" />
                </x-admin.wizard-step>
                <x-admin.wizard-step :index="3">
                    <p class="text-sm text-neutral-600">{{ __('Kiểm tra lại thông tin trước khi hoàn tất.') }}</p>
                </x-admin.wizard-step>
            </x-admin.wizard>
        </form>
    </x-admin.card>

    {{-- Permission matrix --}}
    <x-admin.card title="Permission matrix" :subtitle="__('Ma trận quyền hạn theo vai trò, có select-all theo cột')" :padding="false">
        <x-admin.permission-matrix
            class="rounded-none ring-0"
            :roles="[['key' => 'admin', 'label' => __('Quản trị')], ['key' => 'editor', 'label' => __('Biên tập')]]"
            :permission-groups="[__('Nội dung') => [['key' => 'view', 'label' => __('Xem')], ['key' => 'edit', 'label' => __('Sửa')]]]"
            :checked="['admin' => ['view', 'edit'], 'editor' => ['view']]"
        />
    </x-admin.card>

    {{-- Tag input & Filter builder --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Tag input">
            <x-admin.tag-input name="tags_demo" :label="__('Từ khoá')" :value="['laravel', 'tailwind']" />
        </x-admin.card>

        <x-admin.card title="Filter builder">
            <x-admin.filter-builder :fields="['name' => __('Tên'), 'status' => __('Trạng thái'), 'created_at' => __('Ngày tạo')]" />
        </x-admin.card>
    </div>

    {{-- Kanban board --}}
    <x-admin.card title="Kanban board" :subtitle="__('Kéo thả thẻ giữa các cột (HTML5 drag & drop thuần)')">
        <x-admin.kanban-board :columns="[
            ['key' => 'todo', 'label' => __('Cần làm'), 'cards' => [
                ['id' => 1, 'title' => __('Thiết kế trang đăng nhập'), 'tags' => ['UI'], 'assignee' => 'An'],
                ['id' => 2, 'title' => __('Viết tài liệu API'), 'tags' => ['Docs'], 'assignee' => 'Bình'],
            ]],
            ['key' => 'doing', 'label' => __('Đang làm'), 'cards' => [
                ['id' => 3, 'title' => __('Tích hợp thanh toán'), 'tags' => ['Backend'], 'assignee' => 'Cường'],
            ]],
            ['key' => 'done', 'label' => __('Hoàn tất'), 'cards' => [
                ['id' => 4, 'title' => __('Cấu hình CI/CD'), 'tags' => ['DevOps'], 'assignee' => 'Dung'],
            ]],
        ]" />
    </x-admin.card>

    {{-- Tree view & File manager --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Tree view">
            <x-admin.tree-view :items="[
                ['label' => __('Sản phẩm'), 'icon' => 'folder', 'open' => true, 'children' => [
                    ['label' => __('Quần áo'), 'icon' => 'folder', 'children' => [
                        ['label' => __('Áo'), 'icon' => 'circle'],
                        ['label' => __('Quần'), 'icon' => 'circle'],
                    ]],
                    ['label' => __('Phụ kiện'), 'icon' => 'circle'],
                ]],
                ['label' => __('Đơn hàng'), 'icon' => 'circle'],
            ]" />
        </x-admin.card>

        <x-admin.card title="File manager" :padding="false">
            <x-admin.file-manager class="ring-0" :files="[
                ['name' => __('Hợp đồng.pdf'), 'type' => 'document', 'size' => '240 KB', 'updated_at' => '08/09/2026'],
                ['name' => __('Ảnh bìa.png'), 'type' => 'image', 'size' => '1.1 MB', 'updated_at' => '07/09/2026'],
                ['name' => __('Lưu trữ'), 'type' => 'folder', 'size' => '—', 'updated_at' => '05/09/2026'],
                ['name' => __('Sao lưu.zip'), 'type' => 'archive', 'size' => '8.4 MB', 'updated_at' => '01/09/2026'],
            ]" />
        </x-admin.card>
    </div>

    {{-- Context menu & Rich text editor --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Context menu" :subtitle="__('Chuột phải vào khung bên dưới')">
            <x-admin.context-menu>
                <x-slot:trigger>
                    <div class="flex h-24 items-center justify-center rounded-lg border-2 border-dashed border-neutral-200 text-sm text-neutral-400">
                        {{ __('Chuột phải vào đây') }}
                    </div>
                </x-slot:trigger>
                <x-admin.dropdown-link href="#">{{ __('Sao chép') }}</x-admin.dropdown-link>
                <x-admin.dropdown-link href="#">{{ __('Đổi tên') }}</x-admin.dropdown-link>
                <div class="my-1 border-t border-neutral-100"></div>
                <x-admin.dropdown-link href="#">{{ __('Xoá') }}</x-admin.dropdown-link>
            </x-admin.context-menu>
        </x-admin.card>

        <x-admin.card title="Color picker">
            <div class="max-w-xs">
                <x-admin.color-picker name="brand_color_demo" :label="__('Màu thương hiệu')" value="#4f46e5" />
            </div>
        </x-admin.card>
    </div>

    {{-- Rich text editor --}}
    <x-admin.card title="Rich text editor">
        <x-admin.rich-text-editor name="content_demo" :label="__('Nội dung')" :placeholder="__('Nhập nội dung...')" value="<p>Xin chào, đây là <strong>trình soạn thảo</strong> dùng TipTap — thử bôi đen chữ rồi bấm <em>in nghiêng</em>.</p>" />
    </x-admin.card>

    {{-- Ecommerce & Kho hàng --}}
    <x-admin.card title="Ecommerce & Kho hàng" :subtitle="__('Xem thêm ví dụ đầy đủ ở trang Kho hàng và trang Đơn hàng phía trên')">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div class="space-y-6">
                <div>
                    <p class="mb-2 text-sm text-neutral-500">Stock badge</p>
                    <div class="flex flex-wrap gap-2">
                        <x-admin.stock-badge :quantity="42" />
                        <x-admin.stock-badge :quantity="4" :threshold="5" />
                        <x-admin.stock-badge :quantity="0" />
                    </div>
                </div>

                <div>
                    <p class="mb-2 text-sm text-neutral-500">Price tag</p>
                    <x-admin.price-tag :price="199000" :compare-at="259000" />
                </div>

                <div>
                    <p class="mb-2 text-sm text-neutral-500">Payment method badge</p>
                    <div class="flex flex-wrap gap-2">
                        <x-admin.payment-method-badge method="cod" />
                        <x-admin.payment-method-badge method="bank_transfer" />
                        <x-admin.payment-method-badge method="card" />
                    </div>
                </div>

                <div>
                    <p class="mb-2 text-sm text-neutral-500">Variant selector</p>
                    <x-admin.variant-selector
                        :colors="[['label' => __('Đen'), 'hex' => '#111827'], ['label' => __('Trắng'), 'hex' => '#f9fafb'], ['label' => __('Đỏ'), 'hex' => '#dc2626']]"
                        :sizes="['S', 'M', 'L', 'XL']"
                    />
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <p class="mb-2 text-sm text-neutral-500">Product card</p>
                    <div class="max-w-[14rem]">
                        <x-admin.product-card :name="__('Áo thun basic')" :price="199000" :compare-at="259000" :quantity="42" />
                    </div>
                </div>

                <div>
                    <p class="mb-2 text-sm text-neutral-500">Product gallery</p>
                    <div class="max-w-[14rem]">
                        <x-admin.product-gallery :images="[]" />
                    </div>
                </div>
            </div>
        </div>
    </x-admin.card>

    {{-- Popover, Button group, Lightbox --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-admin.card title="Popover">
            <x-admin.popover title="{{ __('Thông tin') }}">
                <x-slot:trigger>
                    <x-admin.button variant="secondary">{{ __('Bấm để xem') }}</x-admin.button>
                </x-slot:trigger>
                {{ __('Đây là nội dung popover — có thể chứa văn bản dài, link hoặc bất kỳ nội dung nào khác.') }}
            </x-admin.popover>
        </x-admin.card>

        <x-admin.card title="Button group">
            <x-admin.button-group>
                <x-admin.button variant="secondary">{{ __('Ngày') }}</x-admin.button>
                <x-admin.button variant="secondary">{{ __('Tuần') }}</x-admin.button>
                <x-admin.button variant="secondary">{{ __('Tháng') }}</x-admin.button>
            </x-admin.button-group>
        </x-admin.card>
    </div>

    @php
        $lightboxDemoImages = collect(['4f46e5', '0891b2', '16a34a', 'ea580c'])->map(
            fn ($color) => 'data:image/svg+xml,'.rawurlencode("<svg xmlns='http://www.w3.org/2000/svg' width='600' height='600'><rect width='600' height='600' fill='#{$color}'/></svg>")
        )->all();
    @endphp

    <x-admin.card title="Lightbox" :subtitle="__('Bấm vào ảnh để xem toàn màn hình, dùng phím mũi tên để chuyển ảnh')">
        <x-admin.lightbox :images="$lightboxDemoImages" class="max-w-xl" />
    </x-admin.card>

    {{-- Banner --}}
    <x-admin.card title="Banner" :padding="false">
        <x-admin.banner class="rounded-b-xl">
            {{ __('Phiên bản mới đã có mặt!') }}
            <x-slot:action>
                <x-admin.button size="sm" variant="secondary">{{ __('Xem chi tiết') }}</x-admin.button>
            </x-slot:action>
        </x-admin.banner>
    </x-admin.card>

    {{-- Chat bubble --}}
    <x-admin.card title="Chat bubble">
        <div class="space-y-4">
            <x-admin.chat-bubble name="Trần Thị Bình" time="10:42">
                {{ __('Chào bạn, đơn hàng #1082 đã được duyệt chưa nhỉ?') }}
            </x-admin.chat-bubble>
            <x-admin.chat-bubble :own="true" time="10:43" status="{{ __('Đã xem') }}">
                {{ __('Rồi nhé, đang chuẩn bị giao trong hôm nay.') }}
            </x-admin.chat-bubble>
        </div>
    </x-admin.card>

    {{-- Carousel --}}
    <x-admin.card title="Carousel" :padding="false">
        <x-admin.carousel :images="$lightboxDemoImages" class="rounded-b-xl rounded-t-none" />
    </x-admin.card>

    {{-- Marketing / landing page blocks --}}
    <x-admin.card title="Marketing blocks" :subtitle="__('Hero, feature grid, pricing, testimonial, CTA, footer — xem đầy đủ ở trang chủ liên kết trong mục Layouts phía trên')">
        <div class="space-y-8">
            <div>
                <p class="mb-2 text-sm text-neutral-500">Feature item</p>
                <x-admin.feature-grid columns="3">
                    <x-admin.feature-item icon="puzzle" :title="__('90+ component')">
                        {{ __('Đủ cho một hệ thống quản trị thật.') }}
                    </x-admin.feature-item>
                    <x-admin.feature-item icon="settings" :title="__('Tuỳ biến hoàn toàn')">
                        {{ __('Mọi component là file Blade thật trong project của bạn.') }}
                    </x-admin.feature-item>
                    <x-admin.feature-item icon="check-circle" :title="__('Sẵn sàng production')">
                        {{ __('i18n, responsive, đã kiểm thử kỹ.') }}
                    </x-admin.feature-item>
                </x-admin.feature-grid>
            </div>

            <div>
                <p class="mb-2 text-sm text-neutral-500">Pricing plan</p>
                <div class="max-w-xs">
                    <x-admin.pricing-plan
                        :name="__('Chuyên nghiệp')"
                        price="990.000₫"
                        period="{{ __('năm') }}"
                        :highlighted="true"
                        :features="[__('Toàn bộ component'), __('Hỗ trợ qua email')]"
                    />
                </div>
            </div>

            <div>
                <p class="mb-2 text-sm text-neutral-500">Testimonial</p>
                <div class="max-w-sm">
                    <x-admin.testimonial :quote="__('Tiết kiệm cả tuần dựng UI cho team mình.')" name="Nguyễn Văn An" :role="__('CTO')" />
                </div>
            </div>

            <div>
                <p class="mb-2 text-sm text-neutral-500">CTA section</p>
                <x-admin.cta-section :title="__('Sẵn sàng bắt đầu?')" :description="__('Cài đặt trong vài phút.')">
                    <x-slot:actions>
                        <x-admin.button variant="secondary">{{ __('Dùng thử') }}</x-admin.button>
                    </x-slot:actions>
                </x-admin.cta-section>
            </div>

            <div>
                <p class="mb-2 text-sm text-neutral-500">Stats strip</p>
                <x-admin.stats-strip :stats="[
                    ['value' => '10K+', 'label' => __('Người dùng')],
                    ['value' => '99.9%', 'label' => __('Uptime')],
                    ['value' => '90+', 'label' => __('Component')],
                    ['value' => '24/7', 'label' => __('Hỗ trợ')],
                ]" />
            </div>
        </div>
    </x-admin.card>

    {{-- Speed dial --}}
    <x-admin.card title="Speed dial" :subtitle="__('Nút hành động nhanh — luôn nổi ở góc phải dưới màn hình')">
        <p class="text-sm text-neutral-500">{{ __('Xem ở góc phải dưới màn hình.') }}</p>
    </x-admin.card>

    <x-admin.speed-dial>
        <x-admin.speed-dial-action icon="document" :label="__('Tạo tài liệu')" />
        <x-admin.speed-dial-action icon="users" :label="__('Mời thành viên')" />
        <x-admin.speed-dial-action icon="upload" :label="__('Tải file lên')" />
    </x-admin.speed-dial>
</x-layouts.admin>
