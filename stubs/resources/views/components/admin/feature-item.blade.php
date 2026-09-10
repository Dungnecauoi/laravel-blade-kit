@props(['icon' => null, 'title'])

<div {{ $attributes }}>
    @if($icon)
        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary-50 text-primary-600">
            <x-admin.icon :name="$icon" class="h-5 w-5" />
        </div>
    @endif

    <h3 class="mt-4 text-base font-semibold text-neutral-900">{{ $title }}</h3>
    <p class="mt-2 text-sm text-neutral-500">{{ $slot }}</p>
</div>
