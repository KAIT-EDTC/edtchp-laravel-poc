@extends('layouts.app')

@section('title', 'プロダクト')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10">
        <x-text variant="page-title" class="text-center mb-8">Product</x-text>

        {{-- フィルター --}}
        <div class="mb-8">
            <x-content.filter-select
                label="対象:"
                name="tag"
                route="products.index"
                :options="$tags"
                :selected="$tag"
            />
        </div>

        {{-- 製品一覧 --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($items as $product)
                <x-content.product-card :product="$product" />
            @empty
                <x-text variant="caption" tag="p" class="col-span-full text-center py-12">プロダクトがありません。</x-text>
            @endforelse
        </div>

        {{-- ページネーション --}}
        <x-content.pagination route="products.index" :page="$page" :lastPage="$lastPage" :params="['tag' => $tag]" />
    </div>
@endsection
