<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use App\Support\PaginatesArray;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use PaginatesArray;

    public function __construct(
        private ContentService $content,
    ) {}

    public function index(Request $request)
    {
        $year = $request->query('year') ?: null;
        $tag = $request->query('tag') ?: null;
        $page = (int) $request->query('page', 1);
        $perPage = 12;

        $articles = $this->content->list('blog', $year, $tag);
        $tags = $this->content->tags('blog');
        $years = $this->content->years('blog');
        $pagination = $this->paginateArray($articles, $page, $perPage);

        return view('blog.index', [
            'items' => $pagination['items'],
            'page' => $pagination['page'],
            'lastPage' => $pagination['lastPage'],
            'tags' => $tags,
            'years' => $years,
            'year' => $year,
            'tag' => $tag,
        ]);
    }

    public function show(string $slug)
    {
        $article = $this->content->find('blog', $slug);
        abort_if($article === null, 404);

        return view('blog.show', compact('article'));
    }
}
