@props([
    'label' => null,
    'name',
    'type' => 'text',
    'error' => null,
    'hint' => null,
    'required' => false,
    'variant' => 'outline',
    'icon' => null,
    'iconPosition' => 'left',
    'addonBefore' => null,
    'addonAfter' => null,
    'clearable' => false,
])

@php
    $value = old($name, $attributes->get('value'));
    $isPassword = $type === 'password';

    $variants = [
        'outline' => $error
            ? 'ring-1 ring-inset ring-danger-300 focus:ring-2 focus:ring-danger-500'
            : 'ring-1 ring-inset ring-neutral-300 focus:ring-2 focus:ring-primary-600',
        'filled' => $error
            ? 'bg-danger-50 focus:bg-white focus:ring-2 focus:ring-danger-500'
            : 'bg-neutral-100 focus:bg-white focus:ring-2 focus:ring-primary-600',
    ];
    $variantClass = $variants[$variant] ?? $variants['outline'];

    $hasLeftIcon = $icon && $iconPosition === 'left';
    $hasRightIcon = $icon && $iconPosition === 'right';
    $hasRightSlot = $isPassword || $clearable || $hasRightIcon;
    $hasAddon = $addonBefore || $addonAfter;
@endphp

<div x-data="{ show: false, value: @js((string) $value) }">
    @if($label)
        <x-admin.label :for="$name" :required="$required">{{ $label }}</x-admin.label>
    @endif

    <div class="flex rounded-md {{ $hasAddon ? 'shadow-sm' : '' }}">
        @if($addonBefore)
            <span class="inline-flex items-center rounded-l-md border border-r-0 border-neutral-300 bg-neutral-50 px-3 text-sm text-neutral-500">
                {{ $addonBefore }}
            </span>
        @endif

        <div class="relative flex-1">
            @if($hasLeftIcon)
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-admin.icon :name="$icon" class="h-4 w-4 text-neutral-400" />
                </span>
            @endif

            <input
                @if($isPassword)
                    :type="show ? 'text' : 'password'"
                @else
                    type="{{ $type }}"
                @endif
                name="{{ $name }}"
                id="{{ $name }}"
                x-model="value"
                {{ $attributes->except('value')->class([
                    "block w-full rounded-md border-0 py-1.5 text-neutral-900 shadow-sm placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {$variantClass}",
                    'pl-9' => $hasLeftIcon,
                    'pr-9' => $hasRightSlot,
                    'rounded-l-none' => $addonBefore,
                    'rounded-r-none' => $addonAfter,
                ]) }}
            />

            @if($isPassword)
                <button type="button" @click="show = ! show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400 hover:text-neutral-600" tabindex="-1">
                    <span class="sr-only">{{ __('Hiện/ẩn mật khẩu') }}</span>
                    <x-admin.icon name="eye" x-show="! show" class="h-4 w-4" />
                    <x-admin.icon name="eye-off" x-show="show" x-cloak class="h-4 w-4" />
                </button>
            @elseif($clearable)
                <button type="button" x-show="value" x-cloak @click="value = ''" class="absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400 hover:text-neutral-600" tabindex="-1">
                    <span class="sr-only">{{ __('Xoá nội dung') }}</span>
                    <x-admin.icon name="x-mark" class="h-4 w-4" />
                </button>
            @elseif($hasRightIcon)
                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <x-admin.icon :name="$icon" class="h-4 w-4 text-neutral-400" />
                </span>
            @endif
        </div>

        @if($addonAfter)
            <span class="inline-flex items-center rounded-r-md border border-l-0 border-neutral-300 bg-neutral-50 px-3 text-sm text-neutral-500">
                {{ $addonAfter }}
            </span>
        @endif
    </div>

    @if($error)
        <p class="mt-1 text-sm text-danger-600">{{ $error }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-neutral-500">{{ $hint }}</p>
    @endif
</div>
