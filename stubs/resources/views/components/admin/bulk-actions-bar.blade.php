@props([])

{{--
    Expects an ambient Alpine `selected` array on a parent x-data scope,
    e.g. wrap the table + this bar with x-data="{ selected: [] }" and bind
    row checkboxes with x-model="selected" value="{{ $row->id }}".
--}}
<div
    x-show="selected.length > 0"
    x-transition
    x-cloak
    {{ $attributes->class(['flex items-center justify-between gap-x-4 rounded-lg bg-neutral-900 px-4 py-3 text-sm text-white shadow-lg']) }}
>
    <p>
        <span x-text="selected.length"></span> {{ __('mục đã chọn') }}
    </p>

    <div class="flex items-center gap-x-2">
        {{ $slot }}

        <button type="button" @click="selected = []" class="font-medium text-neutral-300 hover:text-white">
            {{ __('Bỏ chọn') }}
        </button>
    </div>
</div>
