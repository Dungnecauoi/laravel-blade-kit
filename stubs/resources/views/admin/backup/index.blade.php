<x-layouts.admin :title="__('Sao lưu')">
    <x-admin.breadcrumb>
        <x-admin.breadcrumb-item current>{{ __('Sao lưu') }}</x-admin.breadcrumb-item>
    </x-admin.breadcrumb>

    <x-admin.card :padding="false">
        <x-slot:actions>
            <form method="POST" action="{{ route('admin.backups.store') }}">
                @csrf
                <x-admin.button type="submit" size="sm">{{ __('Chạy sao lưu ngay') }}</x-admin.button>
            </form>
        </x-slot:actions>

        <x-admin.table :headers="[__('Tệp'), __('Ổ đĩa'), __('Kích thước'), __('Thời gian'), '']">
            @forelse ($backups as $backup)
                <tr>
                    <td class="px-4 py-3 text-sm font-medium text-neutral-900">{{ basename($backup['path']) }}</td>
                    <td class="px-4 py-3 text-sm text-neutral-600">{{ $backup['disk'] }}</td>
                    <td class="px-4 py-3 text-sm text-neutral-600">{{ number_format($backup['size'] / 1024 / 1024, 1) }} MB</td>
                    <td class="px-4 py-3 text-sm text-neutral-600">{{ $backup['date']->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 text-right text-sm">
                        <a href="{{ route('admin.backups.download', ['disk' => $backup['disk'], 'path' => $backup['path']]) }}" class="font-medium text-primary-600 hover:text-primary-500">{{ __('Tải xuống') }}</a>
                        <x-admin.confirm-action
                            :id="'delete-backup-'.md5($backup['disk'].$backup['path'])"
                            :action="route('admin.backups.destroy', ['disk' => $backup['disk'], 'path' => $backup['path']])"
                            :message="__('Xoá bản sao lưu :name?', ['name' => basename($backup['path'])])"
                            class="ml-3"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-sm text-neutral-500">{{ __('Chưa có bản sao lưu nào.') }}</td>
                </tr>
            @endforelse
        </x-admin.table>
    </x-admin.card>
</x-layouts.admin>
