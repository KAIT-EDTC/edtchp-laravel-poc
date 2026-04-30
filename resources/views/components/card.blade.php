@props([
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-white rounded-lg shadow p-4',
        'hoverable' => 'bg-white rounded-lg shadow hover:shadow-md transition-shadow overflow-hidden group',
        'padded' => 'bg-white rounded-lg shadow p-6',
    ];

    $classes = $variants[$variant] ?? $variants['default'];
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
