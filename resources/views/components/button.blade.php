@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
    'tag' => null,
])

@php
    $variants = [
        'primary' => 'inline-block px-6 py-2 bg-main text-white rounded hover:bg-main/80 transition-colors',
        'outline' => 'inline-block px-6 py-2 border border-main text-main rounded hover:bg-main hover:text-white transition-colors',
        'pagination' => 'px-3 py-1.5 text-sm border border-gray-300 rounded hover:bg-gray-100',
        'pagination-active' => 'px-3 py-1.5 text-sm bg-main text-white rounded',
    ];

    $classes = $variants[$variant] ?? $variants['primary'];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@elseif($tag === 'span')
    <span {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </span>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
