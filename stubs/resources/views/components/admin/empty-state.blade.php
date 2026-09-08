@props(['icon' => 'folder', 'title' => null, 'description' => null])

@php
    $title ??= __('Không có dữ liệu');
@endphp

<div {{ $attributes->except('class') }} class="{{ $attributes->get('class') ?: 'py-12 text-center' }}">
    <x-admin.icon :name="$icon" class="mx-auto h-10 w-10 text-neutral-400" />
    <h3 class="mt-3 text-sm font-semibold text-neutral-900">{{ $title }}</h3>
    @if($description)
        <p class="mt-1 text-sm text-neutral-500">{{ $description }}</p>
    @endif
    @isset($action)
        <div class="mt-4">{{ $action }}</div>
    @endisset
</div>
