# PoC

[EDTCHP](https://github.com/KAIT-EDTC)をLaravelに移行するためのPoC.

後述する「実現したいこと」のチェックリストがすべて埋まれば移行可能と判断する.

デプロイ(Basic認証): https://edtchp-laravel-poc.vercel.app/


## 実現したいこと(ざっくり)

- [x] ブログやプロダクトのJSONデータをMarkdownに置き換えられるか
- [x] MarkdownをHTMLにパース出来るか
- [ ] ブログに色や太文字といった装飾ができるか
- [x] ブログやプロダクトをSSRで実装できるか
- [x] フッターヘッダーなどの要素をコンポーネント化できるか
- [ ] 表示速度を改善できるか
- [ ] 開発コストを下げられるか
- [ ] Github Actionsでビルド(Vite)からデプロイまでできるか(さくらインターネットにSSH)

## 技術スタック

- **フレームワーク**: Laravel
- **フロントエンド**: Vite + Blade テンプレート
- **コンテンツ管理**: Markdownファイルベース（`content/`ディレクトリ）
- **デプロイ**: Vercel（`vercel.json` + `api/index.php`）
- **ローカル開発**: Docker Compose
