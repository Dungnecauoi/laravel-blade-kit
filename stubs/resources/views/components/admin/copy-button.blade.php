@props(['value', 'label' => null])

<button
    type="button"
    x-data="{ copied: false }"
    @click="navigator.clipboard.writeText(@js($value)).then(() => { copied = true; setTimeout(() => copied = false, 1500); }).catch(() => {})"
    {{ $attributes->class(['inline-flex items-center gap-x-1.5 text-sm text-neutral-500 hover:text-neutral-700']) }}
>
    <template x-if="! copied">
        <span class="inline-flex items-center gap-x-1.5">
            <x-admin.icon name="copy" class="h-4 w-4" />
            {{ $label ?? __('Sao chép') }}
        </span>
    </template>
    <template x-if="copied">
        <span class="inline-flex items-center gap-x-1.5 text-success-600">
            <x-admin.icon name="check" class="h-4 w-4" />
            {{ __('Đã sao chép') }}
        </span>
    </template>
</button>
