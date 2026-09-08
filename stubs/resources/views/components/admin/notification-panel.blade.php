@props(['notifications' => []])

<x-admin.dropdown align="right" width="80">
    <x-slot:trigger>
        <button type="button" class="relative text-neutral-400 hover:text-neutral-500">
            <span class="sr-only">{{ __('Thông báo') }}</span>
            <x-admin.icon name="bell" class="h-6 w-6" />
            @if(collect($notifications)->contains(fn ($n) => ! ($n['read'] ?? false)))
                <span class="absolute -right-0.5 -top-0.5 h-2.5 w-2.5 rounded-full bg-danger-500 ring-2 ring-white"></span>
            @endif
        </button>
    </x-slot:trigger>

    <div class="flex items-center justify-between border-b border-neutral-100 px-4 py-2.5">
        <p class="text-sm font-semibold text-neutral-900">{{ __('Thông báo') }}</p>
        @if(count($notifications))
            <span class="text-xs text-neutral-400">{{ count($notifications) }}</span>
        @endif
    </div>

    @forelse($notifications as $notification)
        <a href="{{ $notification['url'] ?? '#' }}" class="flex items-start gap-x-3 px-4 py-3 hover:bg-neutral-50">
            <span @class([
                'mt-1.5 h-2 w-2 shrink-0 rounded-full',
                'bg-primary-600' => ! ($notification['read'] ?? false),
                'bg-transparent' => $notification['read'] ?? false,
            ])></span>
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm text-neutral-900">{{ $notification['title'] }}</p>
                @if(!empty($notification['time']))
                    <p class="mt-0.5 text-xs text-neutral-400">{{ $notification['time'] }}</p>
                @endif
            </div>
        </a>
    @empty
        <x-admin.empty-state icon="bell" :title="__('Không có thông báo mới')" class="py-8 text-center" />
    @endforelse
</x-admin.dropdown>
