<footer class="bg-gray-800 text-white">
    <div class="max-w-4xl mx-auto px-4 py-8 text-center">
        <nav class="mb-6 space-x-4">
            <a href="{{ route('home') }}" class="text-gray-200 hover:text-white">ホーム</a>
            <a href="{{ route('blog.index') }}" class="text-gray-200 hover:text-white">ブログ</a>
            <a href="{{ route('products.index') }}" class="text-gray-200 hover:text-white">プロダクト</a>
            <a href="{{ route('contact') }}" class="text-gray-200 hover:text-white">お問い合わせ</a>
        </nav>
        <hr class="border-gray-600 mb-6">
        <div class="flex items-center justify-center gap-3 mb-4">
            <img src="{{ asset('img/EDTC-icon.webp') }}" alt="EDTCロゴ" class="h-[50px] w-auto align-text-bottom">
            <span class="text-5xl font-bold">EDTC</span>
        </div>
        <p class="text-sm text-gray-300 mb-1">学校法人 幾徳学園 神奈川工科大学<br>mail: kait.edtc@gmail.com</p>
        <p class="text-xs text-gray-400 mt-3">&copy; {{ date('Y') }} KAIT EDTC All Rights Reserved</p>
    </div>
</footer>
