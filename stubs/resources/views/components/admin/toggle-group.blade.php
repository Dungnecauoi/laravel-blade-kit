@props(['name' => null, 'options' => [], 'value' => null])

<div
    x-data="{ selected: @js($attributes->get('value', $value)) }"
    {{ $attributes->except('value')->class(['inline-flex rounded-md bg-neutral-100 p-1']) }}
>
    @if($name)
        <input type="hidden" name="{{ $name }}" :value="selected">
    @endif

    @foreach($options as $optionValue => $optionLabel)
        <button
            type="button"
            @click="selected = '{{ $optionValue }}'"
            :class="selected === '{{ $optionValue }}' ? 'bg-white text-neutral-900 shadow-sm' : 'text-neutral-500 hover:text-neutral-700'"
            class="rounded px-3 py-1.5 text-sm font-medium transition-colors"
        >{{ $optionLabel }}</button>
    @endforeach
</div>
