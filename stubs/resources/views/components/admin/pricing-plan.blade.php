@props([
    'name',
    'price',
    'period' => null,
    'description' => null,
    'features' => [],
    'highlighted' => false,
    'cta' => null,
    'ctaHref' => '#',
])

<div @class([
    'flex flex-col rounded-2xl p-8',
    'bg-neutral-900 text-white ring-1 ring-neutral-900' => $highlighted,
    'bg-white text-neutral-900 ring-1 ring-neutral-200' => ! $highlighted,
])>
    @if($highlighted)
        <span class="mb-4 inline-flex w-fit items-center rounded-full bg-primary-500 px-2.5 py-1 text-xs font-medium text-white">
            {{ __('Phổ biến nhất') }}
        </span>
    @endif

    <h3 class="text-lg font-semibold">{{ $name }}</h3>

    @if($description)
        <p @class(['mt-1 text-sm', 'text-neutral-400' => $highlighted, 'text-neutral-500' => ! $highlighted])>{{ $description }}</p>
    @endif

    <p class="mt-6 flex items-baseline gap-x-1">
        <span class="text-4xl font-bold tracking-tight">{{ $price }}</span>
        @if($period)
            <span @class(['text-sm', 'text-neutral-400' => $highlighted, 'text-neutral-500' => ! $highlighted])>/{{ $period }}</span>
        @endif
    </p>

    <ul class="mt-6 flex-1 space-y-3 text-sm">
        @foreach($features as $feature)
            <li class="flex items-center gap-x-2">
                <x-admin.icon name="check" @class(['h-4 w-4 shrink-0', 'text-primary-400' => $highlighted, 'text-primary-600' => ! $highlighted]) />
                {{ $feature }}
            </li>
        @endforeach
    </ul>

    <x-admin.button :href="$ctaHref" :variant="$highlighted ? 'primary' : 'secondary'" class="mt-8 w-full justify-center">
        {{ $cta ?? __('Bắt đầu') }}
    </x-admin.button>
</div>
