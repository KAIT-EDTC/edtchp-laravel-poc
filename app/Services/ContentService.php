<?php

namespace App\Services;

use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ContentService
{
    private MarkdownConverter $markdown;

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
        $dir = base_path("content/{$type}");
        if (! is_dir($dir)) {
            return [];
        }

        $items = [];
        foreach (glob("{$dir}/*.md") as $file) {
            $parsed = $this->parseFile($file, $type);
            if ($parsed === null) {
                continue;
            }

            if ($year && ! str_starts_with($parsed['date'] ?? '', $year)) {
                continue;
            }

            if ($tag && ! in_array($tag, $parsed['tags'] ?? [], true)) {
                continue;
            }

            $items[] = $parsed;
        }

        // 日付降順ソート
        usort($items, fn ($a, $b) => ($b['date'] ?? '') <=> ($a['date'] ?? ''));

        return $items;
    }

    /**
     * 個別コンテンツを取得
     */
    public function find(string $type, string $slug): ?array
    {
        $file = base_path("content/{$type}/{$slug}.md");
        if (! file_exists($file)) {
            return null;
        }

        $parsed = $this->parseFile($file, $type);
        if ($parsed === null) {
            return null;
        }

        // 本文をHTMLに変換
        $parsed['html'] = $this->markdown->convert($parsed['body'])->getContent();
        unset($parsed['body']);

        return $parsed;
    }

    /**
     * 利用可能なタグ一覧を取得
     */
    public function tags(string $type): array
    {
        $tags = [];
        foreach ($this->list($type) as $item) {
            foreach ($item['tags'] ?? [] as $tag) {
                $tags[$tag] = true;
            }
        }

        return array_keys($tags);
    }

    /**
     * 利用可能な年一覧を取得
     */
    public function years(string $type): array
    {
        $years = [];
        foreach ($this->list($type) as $item) {
            $date = $item['date'] ?? '';
            if (strlen($date) >= 4) {
                $years[substr($date, 0, 4)] = true;
            }
        }

        krsort($years);

        return array_keys($years);
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

        $slug = pathinfo($file, PATHINFO_FILENAME);

        return [
            'slug' => $slug,
            'title' => $matter['title'] ?? $slug,
            'date' => $matter['date'] ?? '',
            'thumbnail' => $matter['thumbnail'] ?? null,
            'caption' => $matter['caption'] ?? null,
            'author' => $matter['author'] ?? null,
            'tags' => $matter['tags'] ?? [],
            // Product固有フィールド
            'headline' => $matter['headline'] ?? null,
            'maker' => $matter['maker'] ?? null,
            'target' => $matter['target'] ?? null,
            'price' => $matter['price'] ?? null,
            'body' => $document->body(),
        ];
    }
}
