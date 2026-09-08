@props([
    'name',
    'label' => null,
    'value' => null,
    'hint' => null,
    'error' => null,
    'required' => false,
])

@php
    $content = old($name, $value);
    $ringClass = $error ? 'ring-danger-300' : 'ring-neutral-300';
@endphp

<div x-data="{ html: @js($content ?? '') }">
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <input type="hidden" name="{{ $name }}" :value="html">

    <div class="overflow-hidden rounded-md shadow-sm ring-1 ring-inset focus-within:ring-2 focus-within:ring-primary-600 {{ $ringClass }}">
        <div class="flex flex-wrap items-center gap-x-0.5 border-b border-neutral-200 bg-neutral-50 p-1.5">
            <button type="button" @click="document.execCommand('bold')" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-200">
                <span class="sr-only">{{ __('In đậm') }}</span>
                <x-admin.icon name="bold" class="h-4 w-4" />
            </button>
            <button type="button" @click="document.execCommand('italic')" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-200">
                <span class="sr-only">{{ __('In nghiêng') }}</span>
                <x-admin.icon name="italic" class="h-4 w-4" />
            </button>
            <button type="button" @click="document.execCommand('underline')" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-200">
                <span class="sr-only">{{ __('Gạch chân') }}</span>
                <x-admin.icon name="underline" class="h-4 w-4" />
            </button>
            <span class="mx-1 h-4 w-px bg-neutral-300" aria-hidden="true"></span>
            <button type="button" @click="document.execCommand('insertUnorderedList')" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-200">
                <span class="sr-only">{{ __('Danh sách') }}</span>
                <x-admin.icon name="list-bullet" class="h-4 w-4" />
            </button>
            <button
                type="button"
                @click="const url = prompt('{{ __('Nhập URL') }}'); if (url) document.execCommand('createLink', false, url);"
                class="rounded p-1.5 text-neutral-500 hover:bg-neutral-200"
            >
                <span class="sr-only">{{ __('Chèn liên kết') }}</span>
                <x-admin.icon name="link" class="h-4 w-4" />
            </button>
            <span class="mx-1 h-4 w-px bg-neutral-300" aria-hidden="true"></span>
            <button type="button" @click="document.execCommand('undo')" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-200">
                <span class="sr-only">{{ __('Hoàn tác') }}</span>
                <x-admin.icon name="undo" class="h-4 w-4" />
            </button>
            <button type="button" @click="document.execCommand('redo')" class="rounded p-1.5 text-neutral-500 hover:bg-neutral-200">
                <span class="sr-only">{{ __('Làm lại') }}</span>
                <x-admin.icon name="redo" class="h-4 w-4" />
            </button>
        </div>

        <div
            contenteditable="true"
            x-ref="editor"
            x-init="$refs.editor.innerHTML = html"
            @input="html = $refs.editor.innerHTML"
            class="min-h-[10rem] px-3 py-2 text-sm text-neutral-900 focus:outline-none [&_a]:text-primary-600 [&_a]:underline [&_ol]:list-decimal [&_ol]:pl-5 [&_ul]:list-disc [&_ul]:pl-5"
        ></div>
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
