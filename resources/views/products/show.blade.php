@extends('layouts.app')

@section('title', $product['title'])
@section('description', $product['headline'] ?? '')

@section('ogp')
    <x-content.meta-tags
        :title="$product['title']"
        :description="$product['headline'] ?? ''"
        :image="$product['thumbnail'] ? asset('product/' . $product['thumbnail']) : null"
        type="article"
    />
@endsection

@section('content')
    <article class="max-w-3xl mx-auto px-4 py-10">
        <header class="mb-8">
            <x-text variant="page-title">{{ $product['title'] }}</x-text>
            @if (!empty($product['headline']))
                <x-text variant="body-sm" tag="p" class="mt-2">{{ $product['headline'] }}</x-text>
            @endif
        </header>

        @if ($product['thumbnail'])
            <img src="{{ asset('product/' . $product['thumbnail']) }}" alt="{{ $product['title'] }}" class="w-full rounded-lg mb-8 aspect-video object-cover">
        @endif

        <dl class="grid grid-cols-[auto_1fr] gap-x-4 gap-y-2 mb-8 text-sm">
            @if (!empty($product['maker']))
                <dt class="font-medium text-gray-700">メーカー</dt>
                <dd class="text-gray-600">{{ $product['maker'] }}</dd>
            @endif
            @if (!empty($product['target']))
                <dt class="font-medium text-gray-700">対象</dt>
                <dd class="text-gray-600">{{ $product['target'] }}</dd>
            @endif
            @if (!empty($product['price']))
                <dt class="font-medium text-gray-700">価格</dt>
                <dd class="text-gray-600">{{ $product['price'] }}</dd>
            @endif
        </dl>

        <div class="prose prose-gray max-w-none">
            {!! $product['html'] !!}
        </div>

        <div class="mt-12 pt-6 border-t border-gray-200">
            <a href="{{ route('products.index') }}" class="text-main hover:underline">← プロダクト一覧へ</a>
        </div>
    </article>
@endsection
