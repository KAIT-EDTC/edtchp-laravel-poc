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
        $latestArticles = array_slice($this->content->list('blog'), 0, 5);

        return view('home', compact('latestArticles'));
    }
}
