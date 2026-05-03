<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use App\Support\PaginatesArray;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use PaginatesArray;

    public function __construct(
        private ContentService $content,
    ) {}

    public function index(Request $request)
    {
        $tag = $request->query('tag') ?: null;
        $page = (int) $request->query('page', 1);
        $perPage = 12;

        $products = $this->content->list('products', null, $tag);
        $tags = $this->content->tags('products');
        $pagination = $this->paginateArray($products, $page, $perPage);

        return view('products.index', [
            'items' => $pagination['items'],
            'page' => $pagination['page'],
            'lastPage' => $pagination['lastPage'],
            'tags' => $tags,
            'tag' => $tag,
        ]);
    }

    public function show(string $slug)
    {
        $product = $this->content->find('products', $slug);
        abort_if($product === null, 404);

        return view('products.show', compact('product'));
    }
}
