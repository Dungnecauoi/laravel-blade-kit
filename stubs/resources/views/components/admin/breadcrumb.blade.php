@props([])

<nav {{ $attributes->class(['flex']) }} aria-label="Breadcrumb">
    <ol class="flex items-center gap-x-1.5">
        {{ $slot }}
    </ol>
</nav>
