# Copilot Instructions for edtchp-laravel

このリポジトリでは、神奈川工科大学EDTCのサークル開発を想定し、保守性と引き継ぎやすさを優先します。変更提案・コード生成時は以下を必ず守ってください。

## 1. 基本方針

- Laravel 13 + Blade + Vite 構成に従う。
- 環境差異を防ぐため、npm や PHP 系で依存インストールを伴うコマンドは原則 Docker コンテナ内で実行する。
- 既存の責務分離を維持する。
  - ルーティング: `routes/web.php`
  - 画面制御: `app/Http/Controllers/`
  - コンテンツ取得・変換: `app/Services/ContentService.php`
  - 表示部品: `resources/views/components/`
- ブログ/プロダクトのデータは `content/` の Markdown を正とし、Bladeにデータを直書きしない。
- 既存のルート名、URL構造、`basic.auth` ミドルウェアを壊さない。

## 2. コミット運用（必須）

- Conventional Commits に従う。
- コミットメッセージは「簡潔な日本語」で書く。
- 1コミット1目的（機能追加・修正・リファクタを混ぜない）。

形式:

`<type>(<scope>): <要約>`

例:

- `feat(blog): 記事カードにタグ表示を追加`
- `fix(home): スライダーの自動再生が止まる不具合を修正`
- `refactor(content): フィルタ処理をサービスに集約`
- `docs(readme): Docker起動手順を更新`
- `test(blog): 一覧ページの絞り込みテストを追加`

主な type:

- `feat`: 機能追加
- `fix`: バグ修正
- `refactor`: 振る舞いを変えない内部改善
- `docs`: ドキュメント変更
- `test`: テスト追加・更新
- `chore`: 雑務（依存更新、設定など）
- `style`: フォーマットのみの変更
- `build` / `ci`: ビルド・CI関連

## 3. コメント規約（必須）

- コメントは日本語で記述する。
- 「なぜこの実装か」が分からない箇所に限定して書く。
- 自明な処理への過剰コメントは避ける。
- 複雑な条件分岐、仕様上の制約、将来の注意点を優先して説明する。
- TODO は対応条件が分かる形で書く。
  - 例: `TODO: 記事数が増えたらDB化を再検討する`

## 4. Blade コンポーネント運用（必須）

再利用しそうなUIは `resources/views/components/` に切り出す。

切り出しの目安（いずれかを満たしたら検討）:

- 同等のマークアップが2回以上出現する。
- 1つの塊が15行以上で、可読性を下げている。
- `variant`、状態分岐、表示条件があり、再利用時に差分が props で吸収できる。
- ページ固有でない見た目要素（カード、バッジ、見出し、フィルタ、ページネーションなど）。

実装ルール:

- ファイル名は kebab-case。
- 呼び出しは名前空間付きで統一する（例: `<x-content.blog-card>`、`<x-layout.header>`）。
- `class` は `$attributes->merge()` で拡張可能にする。
- 見た目の差分は `variant` props で吸収する。
- データ取得・重いロジックは Blade で行わず、Controller/Service 側で準備する。

### components 配下ディレクトリの推奨

既存構成を維持しつつ、以下を原則とする。

- `components/layout/`: ヘッダー、フッターなどページ骨格
- `components/content/`: blog/products などドメイン寄り部品
- `components/ui/`: 汎用UI部品（button、badge、card、text など）

補足:

- 既存の `button.blade.php` など直下コンポーネントは、今後の大規模変更時に `components/ui/` へ段階的移行してよい。
- ただし、移行だけを目的にした大規模リネームは行わず、機能改修のタイミングで少しずつ進める。

## 5. フロント実装ルール

- アセット読み込みは Laravel標準の `@vite(['resources/css/app.css', 'resources/js/app.js'])` を使う。
- `public/hot` の手動分岐は追加しない。
- 画像には可能な範囲で `alt`、`width`、`height` を付与する。
- モバイル表示を崩さない（既存のレスポンシブ方針を踏襲）。

## 6. 変更前後の確認

実装後は、最低限以下を確認する。

1. `docker compose up -d --build` で起動できる
2. 対象ページが表示・操作できる
3. 必要に応じて `php artisan test` を実行し、関連テストが通る

見た目変更を含む場合は、差分の意図をPR説明に明記する。

## 7. PR作成時のガイド

- タイトルは Conventional Commits 形式で簡潔に。
- PR本文には以下を含める。
  - 目的
  - 主な変更点
  - 確認手順
  - 影響範囲（blog/products/home など）

---

迷った場合は「将来の部員が最短で理解・修正できるか」を判断基準にしてください。
