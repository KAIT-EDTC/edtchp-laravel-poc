<?php

namespace App\Http\Controllers;

use App\Services\ContentService;

class HomeController extends Controller
{
    public function __construct(
        private ContentService $content,
    ) {}

    public function index()
    {
        $blogItems = $this->content->list('blog', null, 'news');
        $productItems = $this->content->list('products');

        $latestArticles = array_slice($blogItems, 0, 4);
        $latestProducts = array_slice($productItems, 0, 3);

        return view('home', compact('latestArticles', 'latestProducts'));
    }
}
