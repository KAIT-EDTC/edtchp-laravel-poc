@props([
	'variant' => 'default',
	'href' => null,
])

@php
	$variants = [
		'default' => 'inline-flex items-center gap-1 text-main underline underline-offset-2 decoration-main/70 hover:decoration-main transition-colors',
		'blank' => 'inline-flex items-center gap-1 text-main underline underline-offset-2 decoration-main/70 hover:decoration-main transition-colors',
	];

	$classes = $variants[$variant] ?? $variants['default'];
	$defaultAttributes = ['class' => $classes];

	if ($variant === 'blank') {
		$defaultAttributes['target'] = '_blank';
		$defaultAttributes['rel'] = 'noopener noreferrer';
	}
@endphp

@if($href)
	<a href="{{ $href }}" {{ $attributes->merge($defaultAttributes) }}>
		{{ $slot }}
	</a>
@else
	<span {{ $attributes->merge(['class' => $classes]) }}>
		{{ $slot }}
	</span>
@endif
