# PoC

[EDTCHP](https://github.com/KAIT-EDTC)をLaravelに移行するためのPoC.

後述する「実現したいこと」のチェックリストがすべて埋まれば移行可能と判断する.

デプロイ(Basic認証): [https://edtchp-laravel-poc.vercel.app/](https://edtchp-laravel-poc.vercel.app/)

## 実現したいこと(ざっくり)

- [x] ブログやプロダクトのJSONデータをMarkdownに置き換えられるか
- [x] MarkdownをHTMLにパース出来るか
- [ ] ブログに色や太文字といった装飾ができるか
- [x] ブログやプロダクトをSSRで実装できるか
- [x] フッターヘッダーなどの要素をコンポーネント化できるか
- [x] 表示速度を改善できるか
- [ ] 開発コストを下げられるか
- [x] Github Actionsでビルド(Vite)からデプロイまでできるか(さくらインターネットにSSH)

## 技術スタック

- **フレームワーク**: Laravel
- **フロントエンド**: Vite + Blade テンプレート
- **コンテンツ管理**: Markdownファイルベース（`content/`ディレクトリ）
- **デプロイ**: Vercel（`vercel.json` + `api/index.php`）
- **ローカル開発**: Docker Compose

## Vite運用メモ（再発防止）

- Docker on Windows/macOS の bind mount ではファイル変更イベントを取りこぼすことがあるため、`node`サービスはポーリング監視を有効化しています。
- Viteアセットは Laravel 標準の `@vite(['resources/css/app.css', 'resources/js/app.js'])` で読み込み、独自の `public/hot` 分岐を避けています。

### 変更が反映されないとき

1. `docker compose restart node`
2. `docker compose exec app php artisan optimize:clear`
3. ブラウザをハードリロード（`Ctrl+F5`）
