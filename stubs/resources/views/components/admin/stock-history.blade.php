@props(['entries' => []])

<ul {{ $attributes->class(['space-y-4']) }}>
    @forelse($entries as $entry)
        @php $isIn = ($entry['type'] ?? 'in') === 'in'; @endphp
        <li class="flex items-start gap-x-3">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $isIn ? 'bg-success-100 text-success-700' : 'bg-danger-100 text-danger-700' }}">
                <x-admin.icon :name="$isIn ? 'upload' : 'truck'" class="h-4 w-4" />
            </span>
            <div class="min-w-0 flex-1">
                <div class="flex items-center justify-between gap-x-2">
                    <p class="text-sm font-medium text-neutral-900">{{ $isIn ? __('Nhập kho') : __('Xuất kho') }}</p>
                    <span class="text-sm font-semibold {{ $isIn ? 'text-success-600' : 'text-danger-600' }}">
                        {{ $isIn ? '+' : '-' }}{{ $entry['quantity'] }}
                    </span>
                </div>
                @if(! empty($entry['note']))
                    <p class="text-sm text-neutral-500">{{ $entry['note'] }}</p>
                @endif
                @if(! empty($entry['at']))
                    <p class="mt-0.5 text-xs text-neutral-400">{{ $entry['at'] }}</p>
                @endif
            </div>
        </li>
    @empty
        <x-admin.empty-state icon="box" :title="__('Chưa có lịch sử nhập/xuất kho')" />
    @endforelse
</ul>
