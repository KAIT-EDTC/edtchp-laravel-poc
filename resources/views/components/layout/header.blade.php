<header class="fixed top-0 w-full bg-white px-[4%] py-1.5 flex items-center z-30">
    <a href="{{ route('home') }}"><img src="{{ asset('img/EDTC-icon.webp') }}" alt="EDTC" class="block h-[60px] w-auto"></a>
    <a href="{{ route('home') }}" class="text-2xl font-bold p-0">EDTC</a>

    {{-- モバイルナビ --}}
    <nav class="ml-auto md:hidden">
        <div class="relative mt-3">
            <input id="sp-menu-toggle" type="checkbox" class="peer sr-only" aria-label="メニュー切り替え">
            <label for="sp-menu-toggle" class="relative inline-block w-[30px] h-[22px] align-middle cursor-pointer">
                <span class="absolute top-0 block h-[3px] w-[25px] rounded bg-gray-600 before:content-[''] before:absolute before:top-2 before:block before:h-[3px] before:w-[25px] before:rounded before:bg-gray-600 after:content-[''] after:absolute after:top-4 after:block after:h-[3px] after:w-[25px] after:rounded after:bg-gray-600"></span>
            </label>
            <label for="sp-menu-toggle" class="fixed inset-0 z-[90] hidden bg-black/50 transition-all duration-300 peer-checked:block"></label>
            <div class="fixed top-0 left-0 z-[300] w-[70%] max-w-[300px] h-full overflow-auto bg-black/80 transition-all duration-300 -translate-x-[105%] peer-checked:translate-x-0 peer-checked:shadow-[6px_0_25px_rgba(0,0,0,0.15)]">
                <ul class="flex flex-col items-center pt-12 uppercase">
                    <li class="my-2.5 pb-5">
                        <a href="{{ route('home') }}" class="text-white text-xs block w-[200px] text-center hover:text-[#85a7cc]"><span class="text-base font-bold">Home</span><br>ホーム</a>
                    </li>
                    <li class="my-2.5 pb-5">
                        <a href="{{ route('blog.index') }}" class="text-white text-xs block w-[200px] text-center hover:text-[#85a7cc]"><span class="text-base font-bold">Blog</span><br>ブログ</a>
                    </li>
                    <li class="my-2.5 pb-5">
                        <a href="{{ route('products.index') }}" class="text-white text-xs block w-[200px] text-center hover:text-[#85a7cc]"><span class="text-base font-bold">Product</span><br>プロダクト</a>
                    </li>
                    <li class="my-2.5 pb-5">
                        <a href="{{ route('contact') }}" class="text-white text-xs block w-[200px] text-center hover:text-[#85a7cc]"><span class="text-base font-bold">Contact</span><br>お問い合わせ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- PCナビ --}}
    <nav class="hidden ml-auto md:block">
        <ul class="list-none flex items-center">
            <li class="mx-3"><a href="{{ route('home') }}" class="text-xs hover:text-main"><span class="text-[17px] font-bold">Home</span><br>ホーム</a></li>
            <li class="mx-3"><a href="{{ route('blog.index') }}" class="text-xs hover:text-main"><span class="text-[17px] font-bold">Blog</span><br>ブログ</a></li>
            <li class="mx-3"><a href="{{ route('products.index') }}" class="text-xs hover:text-main"><span class="text-[17px] font-bold">Product</span><br>プロダクト</a></li>
            <li class="mx-3"><a href="{{ route('contact') }}" class="text-xs hover:text-main"><span class="text-[17px] font-bold">Contact</span><br>お問い合わせ</a></li>
            <li class="mx-3">
                <a href="https://x.com/kait_edtc" title="X" rel="noopener noreferrer" target="_blank" aria-label="X"
                   class="inline-flex items-center justify-center w-11 h-11 rounded-full border-2 border-gray-700 text-gray-600 hover:text-[#1B95E0] hover:border-white hover:shadow-[inset_0_0_0_22px_#fff] transition-all duration-300">
                    <svg width="16px" height="16px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
                </a>
            </li>
            <li class="ml-3">
                <a href="https://www.instagram.com/kait.edtc/" title="Instagram" rel="noopener noreferrer" target="_blank" aria-label="Instagram"
                   class="inline-flex items-center justify-center w-11 h-11 rounded-full border-2 border-gray-700 text-gray-600 hover:text-[#2b5c84] hover:border-white hover:shadow-[inset_0_0_0_22px_#fff] transition-all duration-300">
                    <svg viewBox="0 0 448 512" aria-hidden="true" class="w-5 h-5 fill-current"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.3 0-74.7-33.4-74.7-74.7s33.4-74.7 74.7-74.7 74.7 33.4 74.7 74.7-33.4 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.9-26.9 26.9-14.9 0-26.9-12-26.9-26.9 0-14.9 12-26.9 26.9-26.9 14.9 0 26.9 12 26.9 26.9zm76.1 27.3c-1.7-35.3-9.8-66.7-35.7-92.5S354.7 37 319.4 35.3c-35.5-2-141.9-2-177.4 0-35.2 1.7-66.6 9.8-92.5 35.7S11.9 128.7 10.2 164c-2 35.5-2 141.9 0 177.4 1.7 35.3 9.8 66.7 35.7 92.5s57.3 34 92.5 35.7c35.5 2 141.9 2 177.4 0 35.3-1.7 66.7-9.8 92.5-35.7s34-57.2 35.7-92.5c2-35.5 2-141.8 0-177.4zM398.8 388c-7.7 19.4-22.7 34.4-42.1 42.1-29.1 11.5-98.2 8.9-132.6 8.9s-103.7 2.7-132.6-8.9c-19.4-7.7-34.4-22.7-42.1-42.1-11.5-29.1-8.9-98.2-8.9-132.6s-2.7-103.7 8.9-132.6c7.7-19.4 22.7-34.4 42.1-42.1 29.1-11.5 98.2-8.9 132.6-8.9s103.7-2.7 132.6 8.9c19.4 7.7 34.4 22.7 42.1 42.1 11.5 29.1 8.9 98.2 8.9 132.6s2.7 103.7-8.9 132.6z"/></svg>
                </a>
            </li>
        </ul>
    </nav>
</header>
