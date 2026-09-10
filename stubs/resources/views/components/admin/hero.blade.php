@props(['eyebrow' => null, 'title', 'description' => null])

<div {{ $attributes->class(['mx-auto max-w-4xl px-4 py-20 text-center sm:px-6 lg:px-8']) }}>
    @if($eyebrow)
        <p class="text-sm font-semibold uppercase tracking-wide text-primary-600">{{ $eyebrow }}</p>
    @endif

    <h1 class="mt-3 text-4xl font-bold tracking-tight text-neutral-900 sm:text-5xl">
        {{ $title }}
    </h1>

    @if($description)
        <p class="mx-auto mt-6 max-w-2xl text-lg text-neutral-500">{{ $description }}</p>
    @endif

    @isset($actions)
        <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
            {{ $actions }}
        </div>
    @endisset
</div>
