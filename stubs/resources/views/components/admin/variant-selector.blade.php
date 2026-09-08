@props(['colors' => [], 'sizes' => [], 'name' => 'variant'])

<div
    x-data="{ color: @js($colors[0]['label'] ?? null), size: @js($sizes[0] ?? null) }"
    {{ $attributes->class(['space-y-4']) }}
>
    <input type="hidden" name="{{ $name }}[color]" :value="color">
    <input type="hidden" name="{{ $name }}[size]" :value="size">

    @if(! empty($colors))
        <div>
            <p class="mb-2 text-sm font-medium text-neutral-700">{{ __('Màu sắc') }}: <span x-text="color"></span></p>
            <div class="flex flex-wrap gap-2">
                <template x-for="option in @js($colors)" :key="option.label">
                    <button
                        type="button"
                        @click="color = option.label"
                        :class="color === option.label ? 'ring-2 ring-offset-2 ring-primary-600' : 'ring-1 ring-inset ring-black/10'"
                        class="h-8 w-8 rounded-full transition-transform hover:scale-110 focus:outline-none"
                        :style="`background-color: ${option.hex}`"
                        :aria-label="option.label"
                        :aria-pressed="color === option.label"
                    ></button>
                </template>
            </div>
        </div>
    @endif

    @if(! empty($sizes))
        <div>
            <p class="mb-2 text-sm font-medium text-neutral-700">{{ __('Kích thước') }}</p>
            <div class="flex flex-wrap gap-2">
                <template x-for="option in @js($sizes)" :key="option">
                    <button
                        type="button"
                        @click="size = option"
                        :class="size === option ? 'border-primary-600 bg-primary-50 text-primary-700' : 'border-neutral-300 text-neutral-700 hover:border-neutral-400'"
                        class="min-w-[2.5rem] rounded-md border px-3 py-1.5 text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500"
                        x-text="option"
                    ></button>
                </template>
            </div>
        </div>
    @endif
</div>
