<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        private ContentService $content,
    ) {}

    public function index(Request $request)
    {
        $year = $request->query('year');
        $tag = $request->query('tag');
        $page = (int) $request->query('page', 1);
        $perPage = 12;

        $articles = $this->content->list('blog', $year, $tag);
        $tags = $this->content->tags('blog');
        $years = $this->content->years('blog');

        $total = count($articles);
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $items = array_slice($articles, ($page - 1) * $perPage, $perPage);

        return view('blog.index', compact('items', 'tags', 'years', 'year', 'tag', 'page', 'lastPage'));
    }

    public function show(string $slug)
    {
        $article = $this->content->find('blog', $slug);
        abort_if($article === null, 404);

        return view('blog.show', compact('article'));
    }
}
