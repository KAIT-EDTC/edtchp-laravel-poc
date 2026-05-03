@props([
    'product',
])

<a href="{{ route('products.show', $product['slug']) }}" class="block group">
    <x-card variant="hoverable">
        @if ($product['thumbnail'])
            <img src="{{ asset('product/' . $product['thumbnail']) }}" alt="{{ $product['title'] }}" class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-300">
        @endif
        <div class="p-4">
            <x-text variant="card-title" class="line-clamp-2">{{ $product['title'] }}</x-text>
            @if (! empty($product['headline']))
                <x-text variant="body-sm" class="mt-1 line-clamp-2">{{ $product['headline'] }}</x-text>
            @endif
        </div>
    </x-card>
</a>
