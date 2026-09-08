@props(['name' => null, 'value' => 0, 'max' => 5, 'readonly' => false])

<div x-data="{ rating: @js((int) $attributes->get('value', $value)), hover: 0 }" class="inline-flex items-center gap-x-1">
    @if($name)
        <input type="hidden" name="{{ $name }}" :value="rating">
    @endif

    @for($i = 1; $i <= $max; $i++)
        <button
            type="button"
            @if($readonly) disabled tabindex="-1" @endif
            @click="rating = {{ $i }}"
            @mouseenter="hover = {{ $i }}"
            @mouseleave="hover = 0"
            :class="(hover || rating) >= {{ $i }} ? 'text-warning-400' : 'text-neutral-300'"
            class="{{ $readonly ? 'cursor-default' : 'cursor-pointer hover:scale-110' }} transition-transform"
        >
            <x-admin.icon name="star" class="h-5 w-5" fill="currentColor" />
        </button>
    @endfor
</div>
