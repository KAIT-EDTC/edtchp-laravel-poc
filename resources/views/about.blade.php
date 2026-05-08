@extends('layouts.app')

@section('title', 'About EDTC')
@section('description', 'EDTCの設立背景、活動体制、外部・内部活動、開発中プロダクトを紹介します。')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-12 space-y-14">
        <section class="text-center max-w-4xl mx-auto">
            <x-text variant="page-title" class="mb-4">
                EDTCについて
            </x-text>
            <x-text variant="body" class="mt-4">
                EDTCは、創設者の佐々木勇輝により2021年4月に設立された神奈川工科大学の学生団体です。
            </x-text>
            <x-text variant="body" class="mt-2">
                「学ぶ側、教える側、どちらも学べる環境づくりを」を掲げ、
                学生が自ら考え工夫しながら、授業やイベントを通して子どもたち・地域の方々へ
                ロボット工作やプログラミングを伝える活動を行っています。
            </x-text>
            <x-text variant="caption" tag="p" class="mt-3">KAIT は KAnagawa Institute of Technology（神奈川工科大学）の略称です。</x-text>
        </section>

        <section>
            <x-text variant="section-title" class="mb-4">活動体制</x-text>
            <x-text variant="body-sm" class="mb-5">
                メンバーは企画部・営業部・広報部・総務部・人事部に分かれ、
                それぞれの分野で専門性を高めながら活動しています。
            </x-text>
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-[680px] text-sm text-left text-gray-700">
                    <thead class="bg-gray-50 text-gray-800">
                        <tr>
                            <th class="px-4 py-3 font-semibold">部署名</th>
                            <th class="px-4 py-3 font-semibold">役割</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3 font-semibold">企画部</td>
                            <td class="px-4 py-3">教材・ロボット開発を担当し、授業で楽しく作れるよう工夫しています。</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3 font-semibold">営業部</td>
                            <td class="px-4 py-3">外部との窓口として、依頼対応や学内外連携の交渉・調整を担当します。</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3 font-semibold">広報部</td>
                            <td class="px-4 py-3">SNS（X, Instagram）やYouTube、公式サイトを通じて情報発信します。</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3 font-semibold">総務部</td>
                            <td class="px-4 py-3">書類作成、備品管理、活動スペース維持などのバックオフィスを担当します。</td>
                        </tr>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3 font-semibold">人事部</td>
                            <td class="px-4 py-3">勧誘やメンバー管理を行い、得意分野に合わせて仕事を割り振ります。</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="space-y-10">
            <div>
                <x-text variant="section-title" class="mb-4">活動内容（外部）</x-text>
                <x-text variant="body-sm" class="mb-5">
                    自作ロボット工作キットや自作ロボットを用いた授業・出張イベントを実施し、
                    ものづくりの楽しさを伝えています。イベントごとに計画と活動報告を行い、
                    反省点を次回へ活かすPDCAを回しています。
                </x-text>
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full min-w-[680px] text-sm text-left text-gray-700">
                        <thead class="bg-gray-50 text-gray-800">
                            <tr>
                                <th class="px-4 py-3 font-semibold">イベント名</th>
                                <th class="px-4 py-3 font-semibold">活動内容</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-gray-200">
                                <td class="px-4 py-3 font-semibold">遊行塾</td>
                                <td class="px-4 py-3">藤嶺学園藤沢中学校で全10回のロボット工作授業を展開。ライントレーサーを、はんだ付けからArduinoプログラミングまで実施。</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <td class="px-4 py-3 font-semibold">幾徳祭（学祭）</td>
                                <td class="px-4 py-3">KAIT工房でロボット展示と簡易プログラミング教室を展開。</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <td class="px-4 py-3 font-semibold">富士発明工夫展</td>
                                <td class="px-4 py-3">ブース出展によりロボット展示を実施。</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <td class="px-4 py-3 font-semibold">富士市ものづくり交流フェア</td>
                                <td class="px-4 py-3">ロボット展示を行い、企業の取り組みを学びつつ活動へのフィードバックを得ています。</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <x-text variant="section-title" class="mb-4">活動内容（内部）</x-text>
                <x-text variant="body-sm" class="mb-5">
                    部内では新入部員向けのアイデアコンテストを実施し、
                    新規開発の促進に加えて企画・計画・立案の経験を積める場をつくっています。
                </x-text>

                <div class="grid gap-6 lg:grid-cols-2">
                    <x-card variant="padded">
                        <x-text variant="card-title" class="mb-3">現在開発中のもの</x-text>
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[320px] text-sm text-left text-gray-700">
                                <thead class="bg-gray-50 text-gray-800">
                                    <tr>
                                        <th class="px-3 py-2 font-semibold">開発名</th>
                                        <th class="px-3 py-2 font-semibold">作成メンバー</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">防犯ブザー</td><td class="px-3 py-2">足立</td></tr>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">ArtoRo</td><td class="px-3 py-2">番倉</td></tr>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">SKYPATCH</td><td class="px-3 py-2">福原</td></tr>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">ラジコンヨット</td><td class="px-3 py-2">青沼</td></tr>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">GASSEN</td><td class="px-3 py-2">渡邉・山口</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </x-card>

                    <x-card variant="padded">
                        <x-text variant="card-title" class="mb-3">授業・展示会で活用中のもの</x-text>
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[320px] text-sm text-left text-gray-700">
                                <thead class="bg-gray-50 text-gray-800">
                                    <tr>
                                        <th class="px-3 py-2 font-semibold">商品名</th>
                                        <th class="px-3 py-2 font-semibold">作成メンバー</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">ライントレーサー</td><td class="px-3 py-2">須藤陸</td></tr>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">相撲ロボット</td><td class="px-3 py-2">上条慶</td></tr>
                                    <tr class="border-t border-gray-200"><td class="px-3 py-2">ぶるぶるくん</td><td class="px-3 py-2">鈴木一平</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </x-card>
                </div>
            </div>
        </section>

        <div class="text-center">
            <x-button variant="primary" :href="route('home')">ホームに戻る</x-button>
        </div>
    </div>
@endsection
