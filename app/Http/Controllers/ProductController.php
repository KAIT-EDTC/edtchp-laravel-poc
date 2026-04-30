<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ContentService $content,
    ) {}

    public function index(Request $request)
    {
        $tag = $request->query('tag');
        $page = (int) $request->query('page', 1);
        $perPage = 12;

        $products = $this->content->list('products', null, $tag);
        $tags = $this->content->tags('products');

        $total = count($products);
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $items = array_slice($products, ($page - 1) * $perPage, $perPage);

        return view('products.index', compact('items', 'tags', 'tag', 'page', 'lastPage'));
    }

    public function show(string $slug)
    {
        $product = $this->content->find('products', $slug);
        abort_if($product === null, 404);

        return view('products.show', compact('product'));
    }
}
