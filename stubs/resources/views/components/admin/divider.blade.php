@props(['label' => null, 'vertical' => false])

@if($vertical)
    <div {{ $attributes->class(['w-px self-stretch bg-neutral-200']) }} role="separator" aria-orientation="vertical"></div>
@elseif($label)
    <div {{ $attributes->class(['relative flex items-center py-2']) }} role="separator">
        <div class="h-px grow bg-neutral-200"></div>
        <span class="mx-3 shrink-0 text-xs font-medium uppercase tracking-wide text-neutral-400">{{ $label }}</span>
        <div class="h-px grow bg-neutral-200"></div>
    </div>
@else
    <hr {{ $attributes->class(['border-neutral-200']) }}>
@endif
