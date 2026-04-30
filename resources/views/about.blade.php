@extends('layouts.app')

@section('title', 'About EDTC')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <x-text variant="page-title" class="text-center mb-4">
            About
            <span class="inline-flex gap-0.5 ml-1">
                <span class="text-[crimson]">E</span><span class="text-[dodgerblue]">D</span><span class="text-[limegreen]">T</span><span class="text-[orange]">C</span>
            </span>
        </x-text>
        <x-text variant="body-sm" tag="p" class="text-center mb-12">EDTCは神奈川工科大学に属する学生団体です。<br>4つの理念に基づいて活動しています。</x-text>

        <div class="grid gap-8 md:grid-cols-2">
            <x-card variant="hoverable">
                <img src="{{ asset('storage/img/EDTC-teaching-machine.webp') }}" alt="Engineering - 工学教育の様子" class="w-full aspect-video object-cover" width="640" height="360">
                <div class="p-6">
                    <div class="text-5xl font-bold text-[crimson]">E</div>
                    <x-text variant="section-title" class="mt-1">ngineering</x-text>
                    <x-text variant="body" class="mt-3">
                        神奈川工科大学（KAIT）に属しており、<br>
                        「<span class="text-[crimson] font-semibold">工学</span>」の知識が豊富な学生団体です。
                    </x-text>
                    <x-text variant="body-sm" class="mt-2">
                        情報系・機械系・電気系など多様な専攻を持つメンバーが集まり、
                        それぞれの専門知識を活かした教育活動を展開しています。
                    </x-text>
                </div>
            </x-card>

            <x-card variant="hoverable">
                <img src="{{ asset('storage/img/EDTC-yugyou-huukei.webp') }}" alt="Dispatch - 出張授業の様子" class="w-full aspect-video object-cover" width="640" height="360">
                <div class="p-6">
                    <div class="text-5xl font-bold text-[dodgerblue]">D</div>
                    <x-text variant="section-title" class="mt-1">ispatch</x-text>
                    <x-text variant="body" class="mt-3">
                        学生ならではの「<span class="text-[dodgerblue] font-semibold">迅速な派遣</span>」により、<br>
                        より早く需要にこたえた授業展開・イベント参加を目指します。
                    </x-text>
                    <x-text variant="body-sm" class="mt-2">
                        学校や地域からのご依頼に柔軟に対応し、
                        子どもたちに科学の楽しさを届けています。
                    </x-text>
                </div>
            </x-card>

            <x-card variant="hoverable">
                <img src="{{ asset('storage/img/EDTC-teaching-sasaki.webp') }}" alt="Teacher - 教える活動の様子" class="w-full aspect-video object-cover" width="640" height="360">
                <div class="p-6">
                    <div class="text-5xl font-bold text-[limegreen]">T</div>
                    <x-text variant="section-title" class="mt-1">eacher</x-text>
                    <x-text variant="body" class="mt-3">
                        学生の作った教材を使った<br>
                        「<span class="text-[limegreen] font-semibold">教える</span>」活動を行っています。
                    </x-text>
                    <x-text variant="body-sm" class="mt-2">
                        プログラミング・ロボット・電子工作など、
                        様々なテーマで子どもたちの興味を引き出す授業を実施しています。
                    </x-text>
                </div>
            </x-card>

            <x-card variant="hoverable">
                <img src="{{ asset('storage/img/EDTC-GroupPhoto.webp') }}" alt="Company - チーム体制" class="w-full aspect-video object-cover" width="640" height="360">
                <div class="p-6">
                    <div class="text-5xl font-bold text-[orange]">C</div>
                    <x-text variant="section-title" class="mt-1">ompany</x-text>
                    <x-text variant="body" class="mt-3">
                        EDTC内部は企画・総務・広報・人事・営業の<br>
                        5つの部署に分かれています。
                    </x-text>
                    <x-text variant="body-sm" class="mt-2">
                        「<span class="text-[orange] font-semibold">企業</span>」のような活動体制により、
                        各部署で役割分担をし、より進化する団体運営を心掛けています。
                    </x-text>
                </div>
            </x-card>
        </div>

        <div class="mt-12 text-center">
            <x-button variant="primary" :href="route('home')">ホームに戻る</x-button>
        </div>
    </div>
@endsection
