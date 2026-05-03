<footer class="bg-surface-dark text-white">
    <div class="max-w-4xl mx-auto px-4 py-8 text-center">
        <nav class="mb-6">
            <div class="w-fit mx-auto">
                <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2 pb-2 px-4 border-b border-[antiquewhite]">
                    <a href="{{ route('home') }}" class="text-[antiquewhite] hover:opacity-80">ホーム</a>
                    <a href="{{ route('blog.index') }}" class="text-[antiquewhite] hover:opacity-80">ブログ</a>
                    <a href="{{ route('products.index') }}" class="text-[antiquewhite] hover:opacity-80">プロダクト</a>
                </div>
                <div class="mt-3 pb-2 px-4 text-center border-b border-[antiquewhite]">
                    <a href="{{ route('contact') }}" class="text-[antiquewhite] hover:opacity-80">お問い合わせ</a>
                </div>
            </div>
        </nav>
        <div class="flex items-center justify-center gap-3 mb-4">
            <img src="{{ asset('img/EDTC-icon.webp') }}" alt="EDTCロゴ" class="h-[50px] w-auto align-text-bottom">
            <span class="text-5xl font-bold">EDTC</span>
        </div>
        <p class="text-sm text-white mb-1">学校法人 幾徳学園 神奈川工科大学<br>mail: kait.edtc@gmail.com</p>
        <p class="text-xs text-gray-400 mt-3">&copy; {{ date('Y') }} KAIT EDTC All Rights Reserved</p>
    </div>
</footer>
