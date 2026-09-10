@props([
    'name',
    'label' => null,
    'value' => [],
    'placeholder' => null,
    'hint' => null,
    'error' => null,
    'required' => false,
])

@php
    $tags = old($name, $attributes->get('value', $value));
    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
@endphp

<div
    x-data="{
        tags: @js($tags),
        draft: '',
        add() {
            const value = this.draft.trim();
            if (value && ! this.tags.includes(value)) {
                this.tags.push(value);
            }
            this.draft = '';
        },
        remove(index) { this.tags.splice(index, 1); },
    }"
>
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <template x-for="tag in tags" :key="tag">
        <input type="hidden" :name="'{{ $name }}[]'" :value="tag">
    </template>

    <div
        @click="$refs.input.focus()"
        {{ $attributes->except('value')->class(["flex flex-wrap items-center gap-1.5 rounded-md bg-white px-2.5 py-2 shadow-sm ring-1 ring-inset focus-within:ring-2 focus-within:ring-primary-600 {$ringClass}"]) }}
    >
        <template x-for="(tag, index) in tags" :key="tag">
            <span class="inline-flex items-center gap-x-1 rounded bg-primary-50 py-0.5 pl-2 pr-1 text-xs font-medium text-primary-700">
                <span x-text="tag"></span>
                <button type="button" @click="remove(index)" class="rounded hover:bg-primary-100 focus:outline-none focus:ring-1 focus:ring-primary-400">
                    <span class="sr-only">{{ __('Xoá') }}</span>
                    <x-admin.icon name="x-mark" class="h-3 w-3" />
                </button>
            </span>
        </template>

        <input
            type="text"
            x-ref="input"
            x-model="draft"
            @keydown.enter.prevent="add()"
            @keydown.comma.prevent="add()"
            @keydown.backspace="if (draft === '' && tags.length) remove(tags.length - 1)"
            @blur="add()"
            id="{{ $name }}"
            placeholder="{{ $placeholder ?? __('Nhập rồi bấm Enter...') }}"
            class="min-w-[8rem] flex-1 border-0 bg-transparent p-1 text-sm text-neutral-900 placeholder:text-neutral-400 focus:outline-none focus:ring-0"
        >
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
