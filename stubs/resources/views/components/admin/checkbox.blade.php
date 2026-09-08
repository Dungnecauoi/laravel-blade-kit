@props(['label' => null, 'name', 'error' => null])

<div>
    <div class="flex items-center gap-x-2">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $attributes->get('value', '1') }}"
            @checked(old($name, $attributes->get('checked')))
            {{ $attributes->except(['checked', 'value'])->class(['h-4 w-4 rounded border-neutral-300 accent-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-1']) }}
        />
        @if($label || $slot->isNotEmpty())
            <label for="{{ $name }}" class="text-sm text-neutral-700 select-none">{{ $label ?? $slot }}</label>
        @endif
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @endif
</div>
