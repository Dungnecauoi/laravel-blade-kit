@props(['label', 'value', 'change' => null, 'trend' => 'up', 'icon' => null])

<x-admin.card {{ $attributes }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-neutral-500">{{ $label }}</p>
            <p class="mt-1 text-2xl font-semibold text-neutral-900">{{ $value }}</p>
        </div>
        @if($icon)
            <div class="rounded-lg bg-primary-50 p-3 text-primary-600">
                <x-admin.icon :name="$icon" class="h-6 w-6" />
            </div>
        @endif
    </div>

    @if($change)
        <p class="mt-3 flex items-center gap-x-1 text-sm {{ $trend === 'up' ? 'text-success-600' : 'text-danger-600' }}">
            <x-admin.icon :name="$trend === 'up' ? 'chevron-up' : 'chevron-down'" class="h-4 w-4" />
            {{ $change }}
        </p>
    @endif
</x-admin.card>
