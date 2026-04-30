@props([
    'variant' => 'default',
    'href' => null,
])

@php
    $variants = [
        'default' => 'inline-block px-2.5 py-0.5 text-xs bg-gray-100 text-gray-600 rounded',
        'clickable' => 'inline-block px-2.5 py-0.5 text-xs bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition-colors',
    ];

    $classes = $variants[$variant] ?? $variants['default'];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <span {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </span>
@endif
