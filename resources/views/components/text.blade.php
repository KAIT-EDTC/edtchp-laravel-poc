@props([
    'variant' => 'body',
    'tag' => null,
])

@php
    $variants = [
        'page-title' => 'text-3xl md:text-4xl font-bold leading-tight text-gray-800',
        'section-title' => 'text-2xl font-bold leading-tight text-gray-800',
        'card-title' => 'text-base font-semibold leading-snug text-gray-800',
        'body' => 'text-base font-normal leading-relaxed text-gray-700',
        'body-sm' => 'text-sm font-normal leading-relaxed text-gray-600',
        'caption' => 'text-sm font-normal leading-normal text-gray-500',
        'caption-xs' => 'text-xs font-normal leading-normal text-gray-500',
    ];

    $defaultTags = [
        'page-title' => 'h1',
        'section-title' => 'h2',
        'card-title' => 'h2',
        'body' => 'p',
        'body-sm' => 'p',
        'caption' => 'span',
        'caption-xs' => 'span',
    ];

    $classes = $variants[$variant] ?? $variants['body'];
    $element = $tag ?? ($defaultTags[$variant] ?? 'p');
@endphp

<{{ $element }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $element }}>
