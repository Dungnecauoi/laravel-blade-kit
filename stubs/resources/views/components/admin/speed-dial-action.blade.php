@props(['icon', 'label'])

<x-admin.tooltip :text="$label" position="left">
    <button
        type="button"
        {{ $attributes->class(['flex h-11 w-11 items-center justify-center rounded-full bg-white text-neutral-600 shadow-lg ring-1 ring-neutral-200 hover:bg-neutral-50']) }}
    >
        <span class="sr-only">{{ $label }}</span>
        <x-admin.icon :name="$icon" class="h-5 w-5" />
    </button>
</x-admin.tooltip>
