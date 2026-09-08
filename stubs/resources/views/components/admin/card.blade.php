@props(['title' => null, 'subtitle' => null, 'padding' => true])

<div {{ $attributes->class(['bg-white rounded-xl shadow-sm ring-1 ring-neutral-200']) }}>
    @if($title || $subtitle || isset($actions))
        <div class="flex items-center justify-between gap-x-4 border-b border-neutral-200 px-5 py-4">
            <div>
                @if($title)
                    <h3 class="text-base font-semibold text-neutral-900">{{ $title }}</h3>
                @endif
                @if($subtitle)
                    <p class="mt-0.5 text-sm text-neutral-500">{{ $subtitle }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex shrink-0 items-center gap-x-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    <div class="{{ $padding ? 'p-5' : '' }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="rounded-b-xl border-t border-neutral-200 bg-neutral-50 px-5 py-3">
            {{ $footer }}
        </div>
    @endisset
</div>
