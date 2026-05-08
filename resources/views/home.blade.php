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

    {{-- About セクション --}}
    <section class="bg-bg-alt py-14">
        <div class="max-w-6xl mx-auto px-4">
            <x-text variant="page-title" class="text-center">
                EDTCについて
            </x-text>
            <x-text variant="body-sm" tag="p" class="text-center mt-3 max-w-3xl mx-auto">
                EDTCは神奈川工科大学に属する学生団体です。4つの理念に基づいて、
                地域や学校での学びを支える活動を続けています。
            </x-text>

            <div class="grid gap-6 md:grid-cols-2 mt-10">
                <x-card variant="hoverable">
                    <img src="{{ asset('img/EDTC-teaching-machine.webp') }}" alt="Engineering - 工学教育の様子" class="w-full aspect-video object-cover" width="640" height="360">
                    <div class="p-6">
                        <div class="text-5xl font-bold text-main">E</div>
                        <x-text variant="section-title" class="mt-1">ngineering</x-text>
                        <x-text variant="body" class="mt-3">
                            神奈川工科大学（KAIT）に属し、
                            「<span class="text-main font-semibold">工学</span>」の知識を活かして活動しています。
                        </x-text>
                    </div>
                </x-card>

                <x-card variant="hoverable">
                    <img src="{{ asset('img/EDTC-yugyou-huukei.webp') }}" alt="Dispatch - 出張授業の様子" class="w-full aspect-video object-cover" width="640" height="360">
                    <div class="p-6">
                        <div class="text-5xl font-bold text-main">D</div>
                        <x-text variant="section-title" class="mt-1">ispatch</x-text>
                        <x-text variant="body" class="mt-3">
                            学生ならではの「<span class="text-main font-semibold">迅速な派遣</span>」で、
                            地域の需要に合わせた授業やイベントに取り組みます。
                        </x-text>
                    </div>
                </x-card>

                <x-card variant="hoverable">
                    <img src="{{ asset('img/EDTC-teaching-sasaki.webp') }}" alt="Teacher - 教える活動の様子" class="w-full aspect-video object-cover" width="640" height="360">
                    <div class="p-6">
                        <div class="text-5xl font-bold text-main">T</div>
                        <x-text variant="section-title" class="mt-1">eacher</x-text>
                        <x-text variant="body" class="mt-3">
                            学生が作った教材を使い、
                            「<span class="text-main font-semibold">教える</span>」活動を行っています。
                        </x-text>
                    </div>
                </x-card>

                <x-card variant="hoverable">
                    <img src="{{ asset('img/EDTC-GroupPhoto.webp') }}" alt="Company - チーム体制" class="w-full aspect-video object-cover" width="640" height="360">
                    <div class="p-6">
                        <div class="text-5xl font-bold text-main">C</div>
                        <x-text variant="section-title" class="mt-1">ompany</x-text>
                        <x-text variant="body" class="mt-3">
                            企画・総務・広報・人事・営業の5部署で分担し、
                            「<span class="text-main font-semibold">企業</span>」のような体制で運営しています。
                        </x-text>
                    </div>
                </x-card>
            </div>

            <div class="mt-10 text-center">
                <x-button variant="outline" :href="route('about')">Aboutページをもっと見る</x-button>
            </div>
        </div>
    </section>

    {{-- 活動内容 --}}
    <section class="max-w-6xl mx-auto px-4 py-14">
        <x-text variant="section-title" class="text-center">活動内容</x-text>
        <div class="grid gap-6 md:grid-cols-3 mt-8">
            <x-card variant="padded" class="border border-gray-100">
                <x-text variant="card-title">出張授業</x-text>
                <x-text variant="body-sm" class="mt-2">
                    小中学生向けに、プログラミングや電子工作を体験できる授業を実施しています。
                    <x-anker href="{{ route('blog.show', '25-04-01-spring-event') }}">授業の様子</x-anker>
                </x-text>
            </x-card>
            <x-card variant="padded" class="border border-gray-100">
                <x-text variant="card-title">地域イベント参加</x-text>
                <x-text variant="body-sm" class="mt-2">
                    学園祭や地域イベントで、ものづくりの楽しさを伝える展示・体験企画を行っています。
                </x-text>
            </x-card>
            <x-card variant="padded" class="border border-gray-100">
                <x-text variant="card-title">教材・プロダクト開発</x-text>
                <x-text variant="body-sm" class="mt-2">
                    <x-anker href="{{ route('products.index') }}">ライントレーサー</x-anker>
                    や
                    <x-anker href="{{ route('products.index') }}">相撲ロボット</x-anker>
                    などの教材やプロダクトを開発し、授業やイベントで活用しています。
                </x-text>
            </x-card>
        </div>
    </section>

    {{-- 開発してるもの --}}
    <section class="max-w-6xl mx-auto px-4 py-14">
        <div class="flex items-end justify-between gap-4 mb-6 flex-wrap">
            <x-text variant="section-title">開発・プロダクト</x-text>
            <x-button variant="outline" :href="route('products.index')">プロダクト一覧へ</x-button>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($latestProducts as $product)
                <x-content.product-card :product="$product" />
            @empty
                <x-text variant="caption" tag="p" class="col-span-full text-center py-8">現在公開中のプロダクトはありません。</x-text>
            @endforelse
        </div>
    </section>

    {{-- NEWS (イベント告知・活動報告) --}}
    @if ($latestArticles)
    <section class="max-w-6xl mx-auto px-4 py-14">
        <div class="flex items-end justify-between gap-4 mb-6 flex-wrap">
            <x-text variant="section-title">NEWS</x-text>
            <x-button variant="outline" :href="route('blog.index')">Blog一覧へ</x-button>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($latestArticles as $article)
                <x-content.blog-card :article="$article" />
            @endforeach
        </div>
    </section>
    @endif
@endsection

@push('scripts')
    @vite(['resources/js/slider.js'])
@endpush
