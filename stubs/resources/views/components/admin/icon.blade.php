@props(['name' => 'circle', 'fill' => 'none'])

@php
    $paths = [
        'home' => '<path d="M4 11.5 12 4l8 7.5" /><path d="M6 10v9a1 1 0 0 0 1 1h4v-5h2v5h4a1 1 0 0 0 1-1v-9" />',
        'puzzle' => '<rect x="4" y="4" width="7" height="7" rx="1.5" /><rect x="13" y="4" width="7" height="7" rx="1.5" /><rect x="4" y="13" width="7" height="7" rx="1.5" /><rect x="13" y="13" width="7" height="7" rx="1.5" />',
        'users' => '<circle cx="9" cy="8" r="3" /><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6" /><circle cx="17" cy="9" r="2.5" /><path d="M15.5 14a5 5 0 0 1 4.5 6" />',
        'settings' => '<circle cx="12" cy="12" r="3" /><path d="M12 3v2M12 19v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M3 12h2M19 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />',
        'folder' => '<path d="M3 7a1 1 0 0 1 1-1h4l2 2h10a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7Z" />',
        'chevron-down' => '<polyline points="6 9 12 15 18 9" />',
        'chevron-up' => '<polyline points="6 15 12 9 18 15" />',
        'chevron-right' => '<polyline points="9 6 15 12 9 18" />',
        'chevron-up-down' => '<polyline points="8 9 12 5 16 9" /><polyline points="8 15 12 19 16 15" />',
        'menu' => '<line x1="4" y1="6" x2="20" y2="6" /><line x1="4" y1="12" x2="20" y2="12" /><line x1="4" y1="18" x2="20" y2="18" />',
        'x-mark' => '<line x1="6" y1="6" x2="18" y2="18" /><line x1="18" y1="6" x2="6" y2="18" />',
        'bell' => '<path d="M6 9a6 6 0 0 1 12 0v5l1.5 3h-15L6 14V9Z" /><path d="M10 20a2 2 0 0 0 4 0" />',
        'search' => '<circle cx="11" cy="11" r="6" /><line x1="20" y1="20" x2="15.5" y2="15.5" />',
        'logout' => '<path d="M9 4H6a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3" /><line x1="21" y1="12" x2="10" y2="12" /><polyline points="17 8 21 12 17 16" />',
        'check' => '<polyline points="5 12 10 17 19 7" />',
        'check-circle' => '<circle cx="12" cy="12" r="9" /><polyline points="8 12.5 11 15.5 16 9" />',
        'x-circle' => '<circle cx="12" cy="12" r="9" /><line x1="9" y1="9" x2="15" y2="15" /><line x1="15" y1="9" x2="9" y2="15" />',
        'exclamation-triangle' => '<path d="M12 4 2.5 20h19L12 4Z" /><line x1="12" y1="10" x2="12" y2="15" /><circle cx="12" cy="17.5" r="0.75" fill="currentColor" stroke="none" />',
        'information-circle' => '<circle cx="12" cy="12" r="9" /><line x1="12" y1="11" x2="12" y2="16" /><circle cx="12" cy="7.5" r="0.75" fill="currentColor" stroke="none" />',
        'plus' => '<line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />',
        'minus' => '<line x1="5" y1="12" x2="19" y2="12" />',
        'eye' => '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" /><circle cx="12" cy="12" r="3" />',
        'eye-off' => '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" /><line x1="3" y1="3" x2="21" y2="21" />',
        'pencil' => '<path d="M4 20h4l10-10-4-4L4 16v4Z" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />',
        'trash' => '<line x1="4" y1="7" x2="20" y2="7" /><path d="M6 7l1 13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1l1-13" /><path d="M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />',
        'dots-vertical' => '<circle cx="12" cy="5" r="1.2" fill="currentColor" stroke="none" /><circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none" /><circle cx="12" cy="19" r="1.2" fill="currentColor" stroke="none" />',
        'sun' => '<circle cx="12" cy="12" r="4" /><line x1="12" y1="2" x2="12" y2="4" /><line x1="12" y1="20" x2="12" y2="22" /><line x1="4" y1="12" x2="2" y2="12" /><line x1="22" y1="12" x2="20" y2="12" /><line x1="5" y1="5" x2="6.5" y2="6.5" /><line x1="17.5" y1="17.5" x2="19" y2="19" /><line x1="5" y1="19" x2="6.5" y2="17.5" /><line x1="17.5" y1="6.5" x2="19" y2="5" />',
        'moon' => '<path d="M20 14.5A8.5 8.5 0 1 1 9.5 4a7 7 0 0 0 10.5 10.5Z" />',
        'chart-bar' => '<rect x="4" y="12" width="3" height="8" /><rect x="10.5" y="8" width="3" height="12" /><rect x="17" y="4" width="3" height="16" />',
        'upload' => '<path d="M12 15V4" /><polyline points="8 8 12 4 16 8" /><path d="M4 15v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3" />',
        'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="3" y1="10" x2="21" y2="10" />',
        'copy' => '<rect x="9" y="9" width="11" height="11" rx="1.5" /><path d="M5 15V5a2 2 0 0 1 2-2h10" />',
        'star' => '<path d="M12 3l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1-5.4 3.1 1.3-6-4.6-4.1 6.1-.6L12 3Z" />',
        'circle' => '<circle cx="12" cy="12" r="8" />',
        'filter' => '<path d="M4 5h16l-6 8v6l-4-2v-4L4 5Z" />',
        'tag' => '<path d="M20 11 13 4H5a1 1 0 0 0-1 1v8l8.5 8.5a1 1 0 0 0 1.4 0l6.1-6.1a1 1 0 0 0 0-1.4Z" /><circle cx="9" cy="9" r="1.2" fill="currentColor" stroke="none" />',
        'link' => '<path d="M9 15 15 9" /><path d="M11 6.5 13 4.5a3.5 3.5 0 0 1 5 5l-2 2" /><path d="M13 17.5 11 19.5a3.5 3.5 0 0 1-5-5l2-2" />',
        'bold' => '<path d="M6 4h6.5a3.5 3.5 0 0 1 0 7H6Z" /><path d="M6 11h7.5a3.5 3.5 0 0 1 0 7H6Z" />',
        'italic' => '<line x1="12" y1="4" x2="9" y2="20" /><line x1="14" y1="4" x2="10.5" y2="4" /><line x1="13.5" y1="20" x2="8" y2="20" />',
        'underline' => '<path d="M6 4v7a6 6 0 0 0 12 0V4" /><line x1="5" y1="20" x2="19" y2="20" />',
        'undo' => '<path d="M7 8H4V5" /><path d="M4 8a8 8 0 1 1-1.7 5" />',
        'redo' => '<path d="M17 8h3V5" /><path d="M20 8a8 8 0 1 0 1.7 5" />',
        'grid' => '<rect x="3" y="3" width="8" height="8" rx="1" /><rect x="13" y="3" width="8" height="8" rx="1" /><rect x="3" y="13" width="8" height="8" rx="1" /><rect x="13" y="13" width="8" height="8" rx="1" />',
        'list-bullet' => '<circle cx="4.5" cy="6" r="1" fill="currentColor" stroke="none" /><circle cx="4.5" cy="12" r="1" fill="currentColor" stroke="none" /><circle cx="4.5" cy="18" r="1" fill="currentColor" stroke="none" /><line x1="8.5" y1="6" x2="21" y2="6" /><line x1="8.5" y1="12" x2="21" y2="12" /><line x1="8.5" y1="18" x2="21" y2="18" />',
        'columns' => '<rect x="3" y="4" width="5.5" height="16" rx="1" /><rect x="9.5" y="4" width="5.5" height="10" rx="1" /><rect x="16" y="4" width="5.5" height="13" rx="1" />',
        'sitemap' => '<rect x="9" y="3" width="6" height="4" rx="1" /><rect x="3" y="17" width="6" height="4" rx="1" /><rect x="15" y="17" width="6" height="4" rx="1" /><path d="M12 7v5M6 17v-3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3" />',
        'paperclip' => '<path d="M8 12.5 14.5 6a3 3 0 0 1 4.2 4.2L11 18a5 5 0 1 1-7-7l6.5-6.5" />',
        'document' => '<path d="M6 3h8l5 5v13a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" /><path d="M14 3v5h5" /><line x1="8" y1="13" x2="16" y2="13" /><line x1="8" y1="17" x2="13" y2="17" />',
        'image' => '<rect x="3" y="4" width="18" height="16" rx="2" /><circle cx="9" cy="10" r="1.7" /><path d="M4 18l6-6 4 4 3-3 3 3" />',
        'receipt' => '<path d="M6 3h12v18l-2.5-1.5L13 21l-2.5-1.5L8 21l-2-1.5V3Z" /><line x1="9" y1="8" x2="15" y2="8" /><line x1="9" y1="12" x2="15" y2="12" />',
        'printer' => '<path d="M6 9V4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v5" /><rect x="3" y="9" width="18" height="8" rx="1.5" /><path d="M6 14h12v7H6Z" />',
        'swatch' => '<path d="M8 4a3 3 0 0 1 3 3v10a3 3 0 1 1-6 0V7a3 3 0 0 1 3-3Z" /><circle cx="8" cy="17" r="1" fill="currentColor" stroke="none" /><path d="M14 6l6.5 6.5a2 2 0 0 1 0 2.8l-3 3a2 2 0 0 1-2.8 0L13 16.6" />',
        'shield-check' => '<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6Z" /><polyline points="9 12 11 14 15 10" />',
        'drag-handle' => '<circle cx="9" cy="6" r="1" fill="currentColor" stroke="none" /><circle cx="15" cy="6" r="1" fill="currentColor" stroke="none" /><circle cx="9" cy="12" r="1" fill="currentColor" stroke="none" /><circle cx="15" cy="12" r="1" fill="currentColor" stroke="none" /><circle cx="9" cy="18" r="1" fill="currentColor" stroke="none" /><circle cx="15" cy="18" r="1" fill="currentColor" stroke="none" />',
        'box' => '<path d="M3 8 12 4l9 4-9 4-9-4Z" /><path d="M3 8v9l9 4 9-4V8" /><line x1="12" y1="12" x2="12" y2="21" />',
        'truck' => '<rect x="2" y="7" width="13" height="10" rx="1" /><path d="M15 10h4l3 3v4h-7Z" /><circle cx="7" cy="19" r="1.7" /><circle cx="17.5" cy="19" r="1.7" />',
        'credit-card' => '<rect x="3" y="5" width="18" height="14" rx="2" /><line x1="3" y1="10" x2="21" y2="10" /><line x1="6" y1="15" x2="10" y2="15" />',
        'wallet' => '<path d="M3 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z" /><path d="M16 12h3v3h-3a1.5 1.5 0 0 1 0-3Z" />',
        'list-numbered' => '<text x="1.5" y="8.5" font-size="6" fill="currentColor" stroke="none">1</text><text x="1.5" y="14.5" font-size="6" fill="currentColor" stroke="none">2</text><text x="1.5" y="20.5" font-size="6" fill="currentColor" stroke="none">3</text><line x1="8.5" y1="6" x2="21" y2="6" /><line x1="8.5" y1="12" x2="21" y2="12" /><line x1="8.5" y1="18" x2="21" y2="18" />',
        'quote' => '<path d="M7 7a3 3 0 0 0-3 3v3a3 3 0 0 0 3 3h1v-6H6a2 2 0 0 1 2-2V7Z" fill="currentColor" stroke="none" /><path d="M17 7a3 3 0 0 0-3 3v3a3 3 0 0 0 3 3h1v-6h-2a2 2 0 0 1 2-2V7Z" fill="currentColor" stroke="none" />',
        'clock' => '<circle cx="12" cy="12" r="9" /><path d="M12 7v5l3.5 2" />',
    ];

    $svgPath = $paths[$name] ?? $paths['circle'];
@endphp

<svg
    {{ $attributes->except('class') }}
    class="{{ $attributes->get('class') ?: 'h-5 w-5' }}"
    viewBox="0 0 24 24"
    fill="{{ $fill }}"
    stroke="currentColor"
    stroke-width="1.5"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
>
    {!! $svgPath !!}
</svg>
