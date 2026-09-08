@props(['name', 'currentUrl' => null, 'label' => null])

<div x-data="{ preview: @js($currentUrl) }" class="flex items-center gap-x-4">
    <template x-if="preview">
        <img :src="preview" class="h-16 w-16 rounded-full object-cover ring-1 ring-neutral-200">
    </template>
    <template x-if="! preview">
        <span class="flex h-16 w-16 items-center justify-center rounded-full bg-neutral-100 text-neutral-400 ring-1 ring-neutral-200">
            <x-admin.icon name="users" class="h-7 w-7" />
        </span>
    </template>

    <div>
        <input
            type="file"
            x-ref="input"
            name="{{ $name }}"
            accept="image/*"
            class="hidden"
            @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview"
        >
        <x-admin.button type="button" variant="secondary" size="sm" @click="$refs.input.click()">
            {{ $label ?? __('Đổi ảnh đại diện') }}
        </x-admin.button>
    </div>
</div>
