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
            <x-content.filter-select
                label="年で絞り込み:"
                name="year"
                route="blog.index"
                :options="$years"
                :selected="$year"
                :preserve="['tag' => $tag]"
            />
            <x-content.filter-select
                label="タグで絞り込み:"
                name="tag"
                route="blog.index"
                :options="$tags"
                :selected="$tag"
                :preserve="['year' => $year]"
            />
        </section>

        {{-- 記事一覧 --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($items as $article)
                <x-content.blog-card :article="$article" />
            @empty
                <x-text variant="caption" tag="p" class="col-span-full text-center py-12">記事がありません。</x-text>
            @endforelse
        </div>

        {{-- ページネーション --}}
        <x-content.pagination route="blog.index" :page="$page" :lastPage="$lastPage" :params="['year' => $year, 'tag' => $tag]" />
    </div>
@endsection
