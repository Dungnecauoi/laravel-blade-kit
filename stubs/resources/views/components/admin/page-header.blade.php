@props(['title', 'description' => null, 'back' => null])

<div {{ $attributes->class(['mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between']) }}>
    <div class="flex items-start gap-x-3">
        @if($back)
            <a
                href="{{ $back }}"
                class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-md text-neutral-400 hover:bg-neutral-100 hover:text-neutral-600"
            >
                <span class="sr-only">{{ __('Quay lại') }}</span>
                <x-admin.icon name="chevron-right" class="h-5 w-5 rotate-180" />
            </a>
        @endif

        <div>
            <h1 class="text-xl font-semibold text-neutral-900">{{ $title }}</h1>
            @if($description)
                <p class="mt-1 text-sm text-neutral-500">{{ $description }}</p>
            @endif
        </div>
    </div>

    @isset($actions)
        <div class="flex shrink-0 flex-wrap items-center gap-x-3">
            {{ $actions }}
        </div>
    @endisset
</div>
