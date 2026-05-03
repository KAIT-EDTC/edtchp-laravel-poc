@props([
    'title',
    'description' => '',
    'type' => 'article',
    'image' => null,
    'siteName' => '神奈川工科大学EDTC',
    'twitterSite' => '@kait_edtc',
])

<meta property="og:title" content="{{ $title }} | {{ $siteName }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ url()->current() }}">
@if ($image)
    <meta property="og:image" content="{{ $image }}">
@endif
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="ja_JP">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ $twitterSite }}">
<meta name="twitter:title" content="{{ $title }} | {{ $siteName }}">
<meta name="twitter:description" content="{{ $description }}">
@if ($image)
    <meta name="twitter:image" content="{{ $image }}">
@endif
