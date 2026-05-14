@extends('layouts.app')

@section('title', $article['title'])
@section('description', $article['caption'] ?? '')

@section('ogp')
    <x-content.meta-tags
        :title="$article['title']"
        :description="$article['caption'] ?? ''"
        :image="$article['thumbnail'] ? asset('blog-img/' . $article['thumbnail']) : null"
        type="article"
    />
@endsection

@section('content')
    <article class="max-w-3xl mx-auto px-4 py-10">
        <header class="mb-8">
            <x-text variant="caption" tag="time">{{ $article['date'] }}</x-text>
            <x-text variant="page-title" class="mt-2">{{ $article['title'] }}</x-text>
            @if (!empty($article['author']))
                <x-text variant="body-sm" tag="p" class="mt-2">{{ $article['author'] }}</x-text>
            @endif
            @if (!empty($article['tags']))
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($article['tags'] as $tag)
                        <x-badge variant="clickable" :href="route('blog.index', ['tag' => $tag])">{{ $tag }}</x-badge>
                    @endforeach
                </div>
            @endif
        </header>

        <div class="prose prose-gray max-w-none">
            {!! $article['html'] !!}
        </div>

        <div class="mt-12 pt-6 border-t border-gray-200">
            <a href="{{ route('blog.index') }}" class="text-main hover:underline">← ブログ一覧へ</a>
        </div>
    </article>
@endsection
