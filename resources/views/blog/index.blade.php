@extends('layouts.app')

@section('title', 'ブログ')

@section('content')
    {{-- ヒーロー --}}
    <section class="relative h-[300px] md:h-[400px] overflow-hidden">
        <img src="{{ asset('img/EDTC-GroupPhoto.webp') }}" alt="" class="absolute inset-0 w-full h-full object-cover" width="1280" height="720" fetchpriority="high">
        <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold">Blog</h1>
            <p class="mt-3 text-sm md:text-base">EDTCの活動や日々の取り組みをお届けします。</p>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-4 py-10">
        {{-- フィルター --}}
        <section class="flex flex-wrap gap-4 mb-8">
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">年で絞り込み:</label>
                <select onchange="location.href=this.value" class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-main">
                    <option value="{{ route('blog.index', array_filter(['tag' => $tag])) }}" @selected(!$year)>すべて</option>
                    @foreach ($years as $y)
                        <option value="{{ route('blog.index', array_filter(['year' => $y, 'tag' => $tag])) }}" @selected($year == $y)>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-700">タグで絞り込み:</label>
                <select onchange="location.href=this.value" class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-main">
                    <option value="{{ route('blog.index', array_filter(['year' => $year])) }}" @selected(!$tag)>すべて</option>
                    @foreach ($tags as $t)
                        <option value="{{ route('blog.index', array_filter(['year' => $year, 'tag' => $t])) }}" @selected($tag == $t)>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
        </section>

        {{-- 記事一覧 --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($items as $article)
                <a href="{{ route('blog.show', $article['slug']) }}" class="block group">
                    <x-card variant="hoverable">
                        @if ($article['thumbnail'])
                            <img src="{{ asset('blog/' . $article['thumbnail']) }}" alt="{{ $article['title'] }}" class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                        <div class="p-4">
                            <x-text variant="caption-xs" tag="time">{{ $article['date'] }}</x-text>
                            <x-text variant="card-title" class="mt-1 line-clamp-2">{{ $article['title'] }}</x-text>
                            @if (!empty($article['tags']))
                                <div class="mt-2 flex flex-wrap gap-1">
                                    @foreach ($article['tags'] as $t)
                                        <x-badge>{{ $t }}</x-badge>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </x-card>
                </a>
            @empty
                <x-text variant="caption" tag="p" class="col-span-full text-center py-12">記事がありません。</x-text>
            @endforelse
        </div>

        {{-- ページネーション --}}
        @if ($lastPage > 1)
            <nav class="mt-10 flex items-center justify-center gap-2">
                @if ($page > 1)
                    <x-button variant="pagination" :href="route('blog.index', array_filter(['year' => $year, 'tag' => $tag, 'page' => $page - 1]))">&laquo; 前へ</x-button>
                @endif
                @for ($i = 1; $i <= $lastPage; $i++)
                    @if ($i === $page)
                        <x-button variant="pagination-active" tag="span">{{ $i }}</x-button>
                    @else
                        <x-button variant="pagination" :href="route('blog.index', array_filter(['year' => $year, 'tag' => $tag, 'page' => $i]))">{{ $i }}</x-button>
                    @endif
                @endfor
                @if ($page < $lastPage)
                    <x-button variant="pagination" :href="route('blog.index', array_filter(['year' => $year, 'tag' => $tag, 'page' => $page + 1]))">次へ &raquo;</x-button>
                @endif
            </nav>
        @endif
    </div>
@endsection
