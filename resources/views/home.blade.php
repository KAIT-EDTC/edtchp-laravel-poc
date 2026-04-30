@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    {{-- スライダー --}}
    <div class="relative w-full h-[70vh] md:h-[50vh] max-[480px]:h-[30vh] overflow-hidden">
        <p class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[5vh] max-[768px]:text-[3.8vh] max-[480px]:text-[3.2vh] font-bold text-white z-10 m-0 p-0">
            学ぶ側、<span class="whitespace-nowrap">教える側、</span><span class="whitespace-nowrap">どちらも学べる</span><br><span class="whitespace-nowrap">環境作りを</span>
        </p>
        <div id="slide" class="w-[300%] h-full flex transition-all duration-300">
            <div class="w-1/3 h-full flex items-center justify-center bg-[#E1F3FC] z-[1]"><img src="{{ asset('img/EDTC-smile-sasaki.webp') }}" alt="EDTC佐々木の笑顔" class="w-full h-full object-cover aspect-video" width="640" height="360"></div>
            <div class="w-1/3 h-full flex items-center justify-center bg-[#FCE8F0] z-[1]"><img src="{{ asset('img/EDTC-nemote-teach.webp') }}" alt="EDTC根本の指導の様子" class="w-full h-full object-cover aspect-video" width="640" height="360"></div>
            <div class="w-1/3 h-full flex items-center justify-center bg-[#E3F1E4] z-[1]"><img src="{{ asset('img/sakura-fix.webp') }}" alt="メンバーが生徒に教えている画像" class="w-full h-full object-cover aspect-video" width="640" height="360"></div>
        </div>
        <span id="prev" class="absolute w-[15px] h-[15px] left-[25px] bottom-1/2 z-[1] cursor-pointer border-t-[3px] border-r-[3px] border-black -rotate-[135deg] translate-y-1/2"></span>
        <span id="next" class="absolute w-[15px] h-[15px] right-[10px] bottom-1/2 z-[1] cursor-pointer border-t-[3px] border-r-[3px] border-black rotate-45 -translate-y-1/2"></span>
        <ul class="absolute bottom-5 w-full flex gap-[18px] z-[1] justify-center items-center list-none p-0 m-0" id="indicator">
            <li class="list w-3.5 h-3.5 rounded-full bg-black border-2 border-black cursor-pointer"></li>
            <li class="list w-3.5 h-3.5 rounded-full bg-white border-2 border-black cursor-pointer"></li>
            <li class="list w-3.5 h-3.5 rounded-full bg-white border-2 border-black cursor-pointer"></li>
        </ul>
    </div>

    {{-- About EDTC リンク --}}
    <section class="py-12 text-center">
        <a href="{{ route('about') }}" class="inline-block group">
            <x-text variant="page-title" class="group-hover:text-main transition-colors">
                About
                <span class="inline-flex gap-0.5 ml-1">
                    <span class="text-[crimson]">E</span><span class="text-[dodgerblue]">D</span><span class="text-[limegreen]">T</span><span class="text-[orange]">C</span>
                </span>
            </x-text>
            <x-text variant="caption" tag="p" class="mt-2 group-hover:text-gray-700 transition-colors">EDTCについて詳しく見る →</x-text>
        </a>
    </section>

    {{-- PV動画 --}}
    <video class="w-full max-w-5xl mx-auto block aspect-video" loop autoplay muted playsinline src="{{ asset('img/EDTC_PV.mp4') }}" controls width="1280" height="720"></video>

    {{-- NEWS --}}
    <section class="max-w-3xl mx-auto px-4 py-12">
        <x-text variant="section-title" class="mb-6 text-center">NEWS</x-text>
        <ul class="space-y-3 list-none p-0 m-0">
            @foreach ($latestArticles as $article)
                <li><a href="{{ route('blog.show', $article['slug']) }}" class="text-gray-700 hover:text-main transition-colors">{{ $article['date'] }} {{ $article['title'] }}</a></li>
            @endforeach
        </ul>
        <div class="mt-6 text-center">
            <x-button variant="outline" :href="route('blog.index')">Blog一覧へ</x-button>
        </div>
    </section>
@endsection

@push('scripts')
    @vite(['resources/js/slider.js'])
@endpush
