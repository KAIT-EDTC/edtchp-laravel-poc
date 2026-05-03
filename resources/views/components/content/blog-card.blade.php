@props([
    'article',
])

<a href="{{ route('blog.show', $article['slug']) }}" class="block group">
    <x-card variant="hoverable">
        @if ($article['thumbnail'])
            <img src="{{ asset('blog-img/' . $article['thumbnail']) }}" alt="{{ $article['title'] }}" class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-300">
        @endif
        <div class="p-4">
            <x-text variant="caption-xs" tag="time">{{ $article['date'] }}</x-text>
            <x-text variant="card-title" class="mt-1 line-clamp-2">{{ $article['title'] }}</x-text>
            @if (! empty($article['tags']))
                <div class="mt-2 flex flex-wrap gap-1">
                    @foreach ($article['tags'] as $tag)
                        <x-badge>{{ $tag }}</x-badge>
                    @endforeach
                </div>
            @endif
        </div>
    </x-card>
</a>
