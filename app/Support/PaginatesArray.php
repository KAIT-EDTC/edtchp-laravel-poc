<?php

namespace App\Support;

trait PaginatesArray
{
    /**
     * @param  array<int, mixed>  $items
     * @return array{items: array<int, mixed>, total: int, page: int, perPage: int, lastPage: int}
     */
    protected function paginateArray(array $items, int $page, int $perPage): array
    {
        $total = count($items);
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));

        return [
            'items' => array_slice($items, ($page - 1) * $perPage, $perPage),
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => $lastPage,
        ];
    }
}
