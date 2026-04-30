@extends('layouts.app')

@section('title', 'プロダクト')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10">
        <x-text variant="page-title" class="text-center mb-8">Product</x-text>

        {{-- フィルター --}}
        <div class="mb-8 flex items-center gap-2">
            <label class="text-sm font-medium text-gray-700">対象:</label>
            <select onchange="location.href=this.value" class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-main">
                <option value="{{ route('products.index') }}" @selected(!$tag)>すべて</option>
                @foreach ($tags as $t)
                    <option value="{{ route('products.index', ['tag' => $t]) }}" @selected($tag == $t)>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        {{-- 製品一覧 --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($items as $product)
                <a href="{{ route('products.show', $product['slug']) }}" class="block group">
                    <x-card variant="hoverable">
                        @if ($product['thumbnail'])
                            <img src="{{ asset('storage/product/' . $product['thumbnail']) }}" alt="{{ $product['title'] }}" class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                        <div class="p-4">
                            <x-text variant="card-title" class="line-clamp-2">{{ $product['title'] }}</x-text>
                            @if (!empty($product['headline']))
                                <x-text variant="body-sm" class="mt-1 line-clamp-2">{{ $product['headline'] }}</x-text>
                            @endif
                        </div>
                    </x-card>
                </a>
            @empty
                <x-text variant="caption" tag="p" class="col-span-full text-center py-12">プロダクトがありません。</x-text>
            @endforelse
        </div>

        {{-- ページネーション --}}
        @if ($lastPage > 1)
            <nav class="mt-10 flex items-center justify-center gap-2">
                @if ($page > 1)
                    <x-button variant="pagination" :href="route('products.index', array_filter(['tag' => $tag, 'page' => $page - 1]))">&laquo; 前へ</x-button>
                @endif
                @for ($i = 1; $i <= $lastPage; $i++)
                    @if ($i === $page)
                        <x-button variant="pagination-active" tag="span">{{ $i }}</x-button>
                    @else
                        <x-button variant="pagination" :href="route('products.index', array_filter(['tag' => $tag, 'page' => $i]))">{{ $i }}</x-button>
                    @endif
                @endfor
                @if ($page < $lastPage)
                    <x-button variant="pagination" :href="route('products.index', array_filter(['tag' => $tag, 'page' => $page + 1]))">次へ &raquo;</x-button>
                @endif
            </nav>
        @endif
    </div>
@endsection
