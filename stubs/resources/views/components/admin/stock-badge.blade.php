@props(['quantity' => 0, 'threshold' => 5])

@php
    if ($quantity <= 0) {
        $color = 'danger';
        $label = __('Hết hàng');
    } elseif ($quantity <= $threshold) {
        $color = 'warning';
        $label = __('Sắp hết').' · '.$quantity;
    } else {
        $color = 'success';
        $label = __('Còn hàng').' · '.$quantity;
    }
@endphp

<x-admin.badge :color="$color" {{ $attributes }}>{{ $label }}</x-admin.badge>
