@props(['name' => null, 'time' => null, 'avatar' => null, 'own' => false, 'status' => null])

<div {{ $attributes->class(['flex items-start gap-2.5', 'flex-row-reverse' => $own]) }}>
    <x-admin.avatar :name="$name" :src="$avatar" size="sm" />

    <div @class(['flex max-w-[320px] flex-col gap-1', 'items-end' => $own])>
        @if($name || $time)
            <div @class(['flex items-center gap-x-1.5', 'flex-row-reverse' => $own])>
                @if($name)
                    <span class="text-sm font-semibold text-neutral-900">{{ $name }}</span>
                @endif
                @if($time)
                    <span class="text-xs text-neutral-400">{{ $time }}</span>
                @endif
            </div>
        @endif

        <div @class([
            'rounded-xl px-4 py-2.5 text-sm',
            'rounded-tr-none bg-primary-600 text-white' => $own,
            'rounded-tl-none bg-neutral-100 text-neutral-700' => ! $own,
        ])>
            {{ $slot }}
        </div>

        @if($status)
            <span class="text-xs text-neutral-400">{{ $status }}</span>
        @endif
    </div>
</div>
