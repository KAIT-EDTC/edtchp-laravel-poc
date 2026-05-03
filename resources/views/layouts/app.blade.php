<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EDTC') | 神奈川工科大学EDTC</title>
    <meta name="description" content="@yield('description', '神奈川工科大学EDTCの公式サイト。工学教育を通じて子どもたちにモノづくりの楽しさを届ける学生団体です。')">
    {{-- OGP --}}
    @section('ogp')
    <meta property="og:title" content="@yield('title', 'ホーム') | 神奈川工科大学EDTC">
    <meta property="og:description" content="@yield('description', '神奈川工科大学EDTCの公式サイト。工学教育を通じて子どもたちにモノづくりの楽しさを届ける学生団体です。')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('img/EDTC-icon.webp') }}">
    <meta property="og:site_name" content="神奈川工科大学EDTC">
    <meta property="og:locale" content="ja_JP">
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@kait_edtc">
    <meta name="twitter:title" content="@yield('title', 'ホーム') | 神奈川工科大学EDTC">
    <meta name="twitter:description" content="@yield('description', '神奈川工科大学EDTCの公式サイト。工学教育を通じて子どもたちにモノづくりの楽しさを届ける学生団体です。')">
    <meta name="twitter:image" content="{{ asset('img/EDTC-icon.webp') }}">
    @show

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="mt-[70px] font-sans leading-normal">
    <x-layout.header />

    <main>
        @yield('content')
    </main>

    <x-layout.footer />

    @stack('scripts')
</body>

</html>
