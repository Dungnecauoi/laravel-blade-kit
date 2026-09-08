@props(['label' => null, 'name', 'value'])

<div class="flex items-center gap-x-2">
    <input
        type="radio"
        name="{{ $name }}"
        id="{{ $name }}-{{ $value }}"
        value="{{ $value }}"
        @checked((string) old($name) === (string) $value)
        {{ $attributes->except('checked')->class(['h-4 w-4 border-neutral-300 accent-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-1']) }}
    />
    @if($label)
        <label for="{{ $name }}-{{ $value }}" class="text-sm text-neutral-700 select-none">{{ $label }}</label>
    @endif
</div>
