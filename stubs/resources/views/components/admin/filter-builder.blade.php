@props(['fields' => [], 'name' => 'filters', 'operators' => null])

@php
    $operators ??= [
        'eq' => __('bằng'),
        'neq' => __('khác'),
        'contains' => __('chứa'),
        'gt' => __('lớn hơn'),
        'lt' => __('nhỏ hơn'),
    ];

    $fieldOptions = collect($fields)->map(fn ($label, $key) => ['value' => (string) $key, 'label' => $label])->values();
    $operatorOptions = collect($operators)->map(fn ($label, $key) => ['value' => (string) $key, 'label' => $label])->values();
@endphp

<div
    x-data="{
        fields: @js($fieldOptions),
        operators: @js($operatorOptions),
        rows: [{ field: @js($fieldOptions[0]['value'] ?? ''), operator: @js($operatorOptions[0]['value'] ?? ''), value: '' }],
        addRow() { this.rows.push({ field: this.fields[0]?.value ?? '', operator: this.operators[0]?.value ?? '', value: '' }); },
        removeRow(index) { this.rows.splice(index, 1); },
    }"
    {{ $attributes->class(['space-y-2']) }}
>
    <template x-for="(row, index) in rows" :key="index">
        <div class="flex flex-wrap items-center gap-2">
            <span class="w-10 shrink-0 text-xs font-medium text-neutral-400" x-text="index === 0 ? '{{ __('Khi') }}' : '{{ __('Và') }}'"></span>

            <div class="relative">
                <select
                    x-model="row.field"
                    :name="`{{ $name }}[${index}][field]`"
                    class="appearance-none rounded-md border-0 bg-white py-1.5 pl-3 pr-8 text-sm text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 focus:outline-none focus:ring-2 focus:ring-primary-600"
                >
                    <template x-for="field in fields" :key="field.value">
                        <option :value="field.value" x-text="field.label"></option>
                    </template>
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <x-admin.icon name="chevron-up-down" class="h-4 w-4 text-neutral-400" />
                </span>
            </div>

            <div class="relative">
                <select
                    x-model="row.operator"
                    :name="`{{ $name }}[${index}][operator]`"
                    class="appearance-none rounded-md border-0 bg-white py-1.5 pl-3 pr-8 text-sm text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 focus:outline-none focus:ring-2 focus:ring-primary-600"
                >
                    <template x-for="operator in operators" :key="operator.value">
                        <option :value="operator.value" x-text="operator.label"></option>
                    </template>
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <x-admin.icon name="chevron-up-down" class="h-4 w-4 text-neutral-400" />
                </span>
            </div>

            <input
                type="text"
                x-model="row.value"
                :name="`{{ $name }}[${index}][value]`"
                placeholder="{{ __('Giá trị') }}"
                class="min-w-0 flex-1 rounded-md border-0 bg-white px-3 py-1.5 text-sm text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-600"
            >

            <button
                type="button"
                @click="removeRow(index)"
                x-show="rows.length > 1"
                class="shrink-0 rounded p-1.5 text-neutral-400 hover:bg-danger-50 hover:text-danger-600 focus:outline-none focus:ring-2 focus:ring-danger-300"
            >
                <span class="sr-only">{{ __('Xoá điều kiện') }}</span>
                <x-admin.icon name="trash" class="h-4 w-4" />
            </button>
        </div>
    </template>

    <x-admin.button type="button" variant="ghost" size="sm" @click="addRow()">
        <x-admin.icon name="plus" class="h-4 w-4" />
        {{ __('Thêm điều kiện') }}
    </x-admin.button>
</div>
