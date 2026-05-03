<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ContentService
{
    private const CACHE_TTL_SECONDS = 600;

    private MarkdownConverter $markdown;

    /** @var array<string, array<int, array>> */
    private array $requestAllItems = [];

    /** @var array<string, array<int, array>> */
    private array $requestListItems = [];

    /** @var array<string, array<string, mixed>|null> */
    private array $requestFindItems = [];

    /** @var array<string, string> */
    private array $requestTypeVersions = [];

    public function __construct()
    {
        $config = [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new AutolinkExtension());

        $this->markdown = new MarkdownConverter($environment);
    }

    /**
     * コンテンツ一覧を取得（日付降順）
     *
     * @param  string       $type  'blog' or 'products'
     * @param  string|null  $year  フィルタ: 年
     * @param  string|null  $tag   フィルタ: タグ
     * @return array<int, array>
     */
    public function list(string $type, ?string $year = null, ?string $tag = null): array
    {
        $requestKey = implode(':', [$type, $year ?? '_', $tag ?? '_']);
        if (array_key_exists($requestKey, $this->requestListItems)) {
            return $this->requestListItems[$requestKey];
        }

        $version = $this->getTypeVersion($type);
        $cacheKey = implode(':', ['content', 'list', $type, $version, $year ?? '_', $tag ?? '_']);

        $items = Cache::remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($type, $year, $tag): array {
            $allItems = $this->getAllItems($type);

            return array_values(array_filter($allItems, function (array $item) use ($year, $tag): bool {
                if ($year && ! str_starts_with((string) ($item['date'] ?? ''), $year)) {
                    return false;
                }

                if ($tag && ! in_array($tag, $item['tags'] ?? [], true)) {
                    return false;
                }

                return true;
            }));
        });

        $this->requestListItems[$requestKey] = $items;

        return $items;
    }

    /**
     * 個別コンテンツを取得
     */
    public function find(string $type, string $slug): ?array
    {
        $requestKey = "{$type}:{$slug}";
        if (array_key_exists($requestKey, $this->requestFindItems)) {
            return $this->requestFindItems[$requestKey];
        }

        $file = base_path("content/{$type}/{$slug}.md");
        if (! file_exists($file)) {
            return null;
        }

        $modifiedAt = (string) (filemtime($file) ?: 0);
        $cacheKey = implode(':', ['content', 'find', $type, $slug, $modifiedAt]);

        $item = Cache::remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($file, $type): ?array {
            $parsed = $this->parseFile($file, $type);
            if ($parsed === null) {
                return null;
            }

            // 本文をHTMLに変換
            $parsed['html'] = $this->markdown->convert($parsed['body'])->getContent();
            unset($parsed['body']);

            return $parsed;
        });

        $this->requestFindItems[$requestKey] = $item;

        return $item;
    }

    /**
     * 利用可能なタグ一覧を取得
     */
    public function tags(string $type): array
    {
        $version = $this->getTypeVersion($type);
        $cacheKey = implode(':', ['content', 'tags', $type, $version]);

        return Cache::remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($type): array {
            $tags = [];
            foreach ($this->getAllItems($type) as $item) {
                foreach ($item['tags'] ?? [] as $tag) {
                    $tags[(string) $tag] = true;
                }
            }

            return array_keys($tags);
        });
    }

    /**
     * 利用可能な年一覧を取得
     */
    public function years(string $type): array
    {
        $version = $this->getTypeVersion($type);
        $cacheKey = implode(':', ['content', 'years', $type, $version]);

        return Cache::remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($type): array {
            $years = [];
            foreach ($this->getAllItems($type) as $item) {
                $date = (string) ($item['date'] ?? '');
                if (strlen($date) >= 4) {
                    $years[substr($date, 0, 4)] = true;
                }
            }

            krsort($years);

            return array_keys($years);
        });
    }

    /**
     * @return array<int, array>
     */
    private function getAllItems(string $type): array
    {
        if (array_key_exists($type, $this->requestAllItems)) {
            return $this->requestAllItems[$type];
        }

        $version = $this->getTypeVersion($type);
        $cacheKey = implode(':', ['content', 'all', $type, $version]);

        $items = Cache::remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($type): array {
            $dir = base_path("content/{$type}");
            if (! is_dir($dir)) {
                return [];
            }

            $items = [];
            foreach (glob("{$dir}/*.md") ?: [] as $file) {
                $parsed = $this->parseFile($file, $type);
                if ($parsed !== null) {
                    $items[] = $parsed;
                }
            }

            // 日付降順ソート
            usort($items, fn (array $a, array $b): int => ((string) ($b['date'] ?? '')) <=> ((string) ($a['date'] ?? '')));

            return $items;
        });

        $this->requestAllItems[$type] = $items;

        return $items;
    }

    private function getTypeVersion(string $type): string
    {
        if (array_key_exists($type, $this->requestTypeVersions)) {
            return $this->requestTypeVersions[$type];
        }

        $dir = base_path("content/{$type}");
        if (! is_dir($dir)) {
            $this->requestTypeVersions[$type] = 'missing';

            return 'missing';
        }

        $files = glob("{$dir}/*.md") ?: [];
        $latestModified = (int) (filemtime($dir) ?: 0);
        foreach ($files as $file) {
            $latestModified = max($latestModified, (int) (filemtime($file) ?: 0));
        }

        $version = implode('-', [count($files), $latestModified]);
        $this->requestTypeVersions[$type] = $version;

        return $version;
    }

    /**
     * Markdownファイルをパース
     */
    private function parseFile(string $file, string $type): ?array
    {
        $content = file_get_contents($file);
        if ($content === false) {
            return null;
        }

        $document = YamlFrontMatter::parse($content);
        $matter = $document->matter();
        $tags = $matter['tags'] ?? [];
        if (is_string($tags) && $tags !== '') {
            $tags = [$tags];
        }
        if (! is_array($tags)) {
            $tags = [];
        }

        $slug = pathinfo($file, PATHINFO_FILENAME);

        return [
            'slug' => $slug,
            'title' => $matter['title'] ?? $slug,
            'date' => $matter['date'] ?? '',
            'thumbnail' => $matter['thumbnail'] ?? null,
            'caption' => $matter['caption'] ?? null,
            'author' => $matter['author'] ?? null,
            'tags' => array_values($tags),
            // Product固有フィールド
            'headline' => $matter['headline'] ?? null,
            'maker' => $matter['maker'] ?? null,
            'target' => $matter['target'] ?? null,
            'price' => $matter['price'] ?? null,
            'body' => $document->body(),
        ];
    }
}
