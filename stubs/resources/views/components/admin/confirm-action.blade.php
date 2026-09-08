@props([
    'id',
    'action',
    'method' => 'DELETE',
    'title' => null,
    'message' => null,
    'triggerLabel' => null,
    'triggerVariant' => 'danger',
    'confirmLabel' => null,
    'cancelLabel' => null,
])

@php
    $title ??= __('Xác nhận hành động');
    $message ??= __('Bạn có chắc chắn muốn thực hiện hành động này không? Hành động này không thể hoàn tác.');
    $triggerLabel ??= __('Xoá');
    $confirmLabel ??= __('Xác nhận');
    $cancelLabel ??= __('Huỷ');
@endphp

<x-admin.button
    type="button"
    :variant="$triggerVariant"
    size="sm"
    @click="$dispatch('open-modal', '{{ $id }}')"
    {{ $attributes }}
>
    {{ $triggerLabel }}
</x-admin.button>

<x-admin.modal :id="$id" :title="$title">
    <p class="text-sm text-neutral-600">{{ $message }}</p>

    <x-slot:footer>
        <x-admin.button type="button" variant="secondary" @click="$dispatch('close-modal', '{{ $id }}')">
            {{ $cancelLabel }}
        </x-admin.button>

        <form method="POST" action="{{ $action }}">
            @csrf
            @if(strtoupper($method) !== 'POST')
                @method($method)
            @endif
            <x-admin.button type="submit" variant="danger">{{ $confirmLabel }}</x-admin.button>
        </form>
    </x-slot:footer>
</x-admin.modal>
