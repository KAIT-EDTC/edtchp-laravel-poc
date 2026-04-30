@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-10 text-center">
        <x-text variant="page-title" class="mb-8 text-center">Contact Us</x-text>
        <iframe
            src="https://docs.google.com/forms/d/e/1FAIpQLSdZ31zzlqOqCevn0sD0Fti0XwjZTHCDsz3Hja8r1q6oKgxyPw/viewform?embedded=true"
            width="640"
            height="1100"
            frameborder="0"
            marginheight="0"
            marginwidth="0"
            loading="lazy"
            class="mx-auto max-w-full"
        >読み込んでいます…</iframe>
    </div>
@endsection
