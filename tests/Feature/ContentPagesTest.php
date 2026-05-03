<?php

namespace Tests\Feature;

use App\Services\ContentService;
use Tests\TestCase;

class ContentPagesTest extends TestCase
{
    public function test_blog_pages_render_successfully(): void
    {
        $this->get('/blog')->assertOk();

        $slug = $this->existingSlug('blog');
        $this->get("/blog/{$slug}")->assertOk();

        $this->get('/blog/not-found-slug')->assertNotFound();
    }

    public function test_products_pages_render_successfully(): void
    {
        $this->get('/products')->assertOk();

        $slug = $this->existingSlug('products');
        $this->get("/products/{$slug}")->assertOk();

        $this->get('/products/not-found-slug')->assertNotFound();
    }

    public function test_blog_filters_and_pagination_queries_are_supported(): void
    {
        $service = app(ContentService::class);
        $items = $service->list('blog');

        $this->assertNotEmpty($items);

        $item = $items[0];
        $year = substr((string) ($item['date'] ?? ''), 0, 4);
        $tag = $item['tags'][0] ?? null;

        $query = [
            'page' => 1,
        ];

        if ($year !== '') {
            $query['year'] = $year;
        }

        if (is_string($tag) && $tag !== '') {
            $query['tag'] = $tag;
        }

        $this->get('/blog?'.http_build_query($query))->assertOk();
    }

    public function test_products_filters_and_pagination_queries_are_supported(): void
    {
        $service = app(ContentService::class);
        $items = $service->list('products');

        $this->assertNotEmpty($items);

        $query = [
            'page' => 1,
        ];

        $tag = $items[0]['tags'][0] ?? null;
        if (is_string($tag) && $tag !== '') {
            $query['tag'] = $tag;
        }

        $this->get('/products?'.http_build_query($query))->assertOk();
    }

    private function existingSlug(string $type): string
    {
        $files = glob(base_path("content/{$type}/*.md")) ?: [];

        $this->assertNotEmpty($files, "No markdown file found in content/{$type}");

        $firstFile = $files[0];

        return pathinfo($firstFile, PATHINFO_FILENAME);
    }
}
