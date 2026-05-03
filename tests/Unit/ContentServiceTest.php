<?php

namespace Tests\Unit;

use App\Services\ContentService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ContentServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
    }

    public function test_list_returns_items_sorted_by_date_descending(): void
    {
        $service = app(ContentService::class);
        $items = $service->list('blog');

        $this->assertNotEmpty($items);

        $dates = array_map(static fn (array $item): string => (string) ($item['date'] ?? ''), $items);
        $sorted = $dates;
        rsort($sorted);

        $this->assertSame($sorted, $dates);
    }

    public function test_tags_and_years_are_unique_and_sorted(): void
    {
        $service = app(ContentService::class);

        $tags = $service->tags('blog');
        $years = $service->years('blog');

        $this->assertSame(array_values(array_unique($tags)), $tags);

        $sortedYears = $years;
        rsort($sortedYears);
        $this->assertSame($sortedYears, $years);
    }

    public function test_find_returns_html_and_hides_raw_body(): void
    {
        $service = app(ContentService::class);
        $items = $service->list('blog');

        $this->assertNotEmpty($items);

        $slug = (string) $items[0]['slug'];
        $article = $service->find('blog', $slug);

        $this->assertNotNull($article);
        $this->assertArrayHasKey('html', $article);
        $this->assertArrayNotHasKey('body', $article);
        $this->assertNotSame('', trim((string) $article['html']));
    }
}
