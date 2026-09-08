@props([
    'name',
    'label' => null,
    'accept' => null,
    'multiple' => false,
    'hint' => null,
    'error' => null,
    'required' => false,
])

<div
    x-data="{
        files: [],
        dragging: false,
        addFiles(fileList) {
            this.files = {{ $multiple ? 'true' : 'false' }} ? [...this.files, ...Array.from(fileList)] : Array.from(fileList).slice(0, 1);
            this.syncInput();
        },
        removeFile(index) {
            this.files.splice(index, 1);
            this.syncInput();
        },
        syncInput() {
            const transfer = new DataTransfer();
            this.files.forEach((file) => transfer.items.add(file));
            this.$refs.input.files = transfer.files;
        },
        isImage(file) {
            return file.type.startsWith('image/');
        },
        preview(file) {
            return URL.createObjectURL(file);
        },
        formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1024 / 1024).toFixed(1) + ' MB';
        },
    }"
>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <div
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="dragging = false; addFiles($event.dataTransfer.files)"
        @click="$refs.input.click()"
        :class="dragging ? 'border-primary-400 bg-primary-50' : 'border-neutral-300 hover:border-neutral-400'"
        class="cursor-pointer rounded-lg border-2 border-dashed px-6 py-8 text-center transition-colors"
    >
        <input
            type="file"
            x-ref="input"
            id="{{ $name }}"
            name="{{ $name }}{{ $multiple ? '[]' : '' }}"
            class="hidden"
            @if($multiple) multiple @endif
            @if($accept) accept="{{ $accept }}" @endif
            @change="addFiles($event.target.files)"
        >

        <x-admin.icon name="upload" class="mx-auto h-8 w-8 text-neutral-400" />
        <p class="mt-2 text-sm text-neutral-600">
            <span class="font-medium text-primary-600">{{ __('Bấm để chọn') }}</span>
            {{ __('hoặc kéo thả file vào đây') }}
        </p>
        @if($hint)
            <p class="mt-1 text-xs text-neutral-400">{{ $hint }}</p>
        @endif
    </div>

    <ul class="mt-3 space-y-2" x-show="files.length > 0" x-cloak>
        <template x-for="(file, index) in files" :key="file.name + file.size">
            <li class="flex items-center gap-x-3 rounded-md border border-neutral-200 px-3 py-2">
                <template x-if="isImage(file)">
                    <img :src="preview(file)" class="h-10 w-10 rounded object-cover">
                </template>
                <template x-if="! isImage(file)">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded bg-neutral-100 text-neutral-400">
                        <x-admin.icon name="folder" class="h-5 w-5" />
                    </span>
                </template>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm text-neutral-900" x-text="file.name"></p>
                    <p class="text-xs text-neutral-400" x-text="formatSize(file.size)"></p>
                </div>
                <button type="button" @click="removeFile(index)" class="shrink-0 text-neutral-400 hover:text-danger-600">
                    <span class="sr-only">{{ __('Xoá') }}</span>
                    <x-admin.icon name="x-mark" class="h-4 w-4" />
                </button>
            </li>
        </template>
    </ul>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @endif
</div>
