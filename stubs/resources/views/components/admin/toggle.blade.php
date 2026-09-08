@props(['name', 'label' => null, 'checked' => false])

<div x-data="{ enabled: @js((bool) old($name, $checked)) }">
    <label class="inline-flex items-center gap-x-3">
        <input type="hidden" name="{{ $name }}" :value="enabled ? 1 : 0">

        <button
            type="button"
            role="switch"
            :aria-checked="enabled.toString()"
            @click="enabled = ! enabled"
            :class="enabled ? 'bg-primary-600' : 'bg-neutral-200'"
            {{ $attributes->class(['relative inline-flex h-6 w-11 shrink-0 rounded-full transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-600 focus-visible:ring-offset-2']) }}
        >
            <span class="sr-only">{{ $label ?? __('Bật/tắt') }}</span>
            <span
                aria-hidden="true"
                :class="enabled ? 'translate-x-5' : 'translate-x-0'"
                class="pointer-events-none inline-block h-5 w-5 translate-x-0 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
            ></span>
        </button>

        @if($label)
            <span class="text-sm text-neutral-700">{{ $label }}</span>
        @endif
    </label>
</div>
