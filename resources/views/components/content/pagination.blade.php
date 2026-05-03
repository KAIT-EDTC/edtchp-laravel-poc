@props([
    'route',
    'page' => 1,
    'lastPage' => 1,
    'params' => [],
])

@if ($lastPage > 1)
    @php
        $buildUrl = static function (int $targetPage) use ($route, $params): string {
            $query = array_filter(
                array_merge($params, ['page' => $targetPage]),
                static fn ($value): bool => $value !== null && $value !== ''
            );

            return route($route, $query);
        };
    @endphp

    <nav class="mt-10 flex items-center justify-center gap-2">
        @if ($page > 1)
            <x-button variant="pagination" :href="$buildUrl($page - 1)">&laquo; 前へ</x-button>
        @endif

        @for ($i = 1; $i <= $lastPage; $i++)
            @if ($i === $page)
                <x-button variant="pagination-active" tag="span">{{ $i }}</x-button>
            @else
                <x-button variant="pagination" :href="$buildUrl($i)">{{ $i }}</x-button>
            @endif
        @endfor

        @if ($page < $lastPage)
            <x-button variant="pagination" :href="$buildUrl($page + 1)">次へ &raquo;</x-button>
        @endif
    </nav>
@endif
