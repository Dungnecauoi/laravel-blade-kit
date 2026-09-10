@props(['title', 'description' => null])

<div {{ $attributes->class(['rounded-2xl bg-primary-600 px-6 py-16 text-center sm:px-16']) }}>
    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ $title }}</h2>

    @if($description)
        <p class="mx-auto mt-4 max-w-xl text-primary-100">{{ $description }}</p>
    @endif

    @isset($actions)
        <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
            {{ $actions }}
        </div>
    @endisset
</div>
