<x-layouts.admin :title="__('Cài đặt')">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item :href="route('admin.dashboard')">{{ __('Tổng quan') }}</x-admin.breadcrumb-item>
        <x-admin.breadcrumb-item current>{{ __('Cài đặt') }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    @if(count($panels))
        <x-admin.tabs :default="$panels[0]['key']">
            <x-slot:tabs>
                @foreach($panels as $panel)
                    <x-admin.tab-button :value="$panel['key']">{{ $panel['label'] }}</x-admin.tab-button>
                @endforeach
            </x-slot:tabs>

            @foreach($panels as $panel)
                <x-admin.tab-panel :value="$panel['key']">
                    @include($panel['view'])
                </x-admin.tab-panel>
            @endforeach
        </x-admin.tabs>
    @else
        <x-admin.empty-state :title="__('Chưa có mục cài đặt nào')" />
    @endif
</x-layouts.admin>
