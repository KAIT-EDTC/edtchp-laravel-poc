@extends('layouts.app')

@section('title', $article['title'])
@section('description', $article['caption'] ?? '')

@section('ogp')
    <meta property="og:title" content="{{ $article['title'] }} | 神奈川工科大学EDTC">
    <meta property="og:description" content="{{ $article['caption'] ?? '' }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($article['thumbnail'])
        <meta property="og:image" content="{{ asset('storage/blog/' . $article['thumbnail']) }}">
    @endif
    <meta property="og:site_name" content="神奈川工科大学EDTC">
    <meta property="og:locale" content="ja_JP">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@kait_edtc">
    <meta name="twitter:title" content="{{ $article['title'] }} | 神奈川工科大学EDTC">
    <meta name="twitter:description" content="{{ $article['caption'] ?? '' }}">
    @if ($article['thumbnail'])
        <meta name="twitter:image" content="{{ asset('storage/blog/' . $article['thumbnail']) }}">
    @endif
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

        @if ($article['thumbnail'])
            <img src="{{ asset('storage/blog/' . $article['thumbnail']) }}" alt="{{ $article['title'] }}" class="w-full rounded-lg mb-8 aspect-video object-cover">
        @endif

        <div class="prose prose-gray max-w-none">
            {!! $article['html'] !!}
        </div>

        <div class="mt-12 pt-6 border-t border-gray-200">
            <a href="{{ route('blog.index') }}" class="text-main hover:underline">← ブログ一覧へ</a>
        </div>
    </article>
@endsection
