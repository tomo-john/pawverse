# 初期memo

## プロジェクト作成

```
composer create-project laravel/laravel pawverse
```

## Breeze導入

```bash
composer require laravel/breeze --dev  # --devは開発用の意味
php artisan breeze:install             # Blade with Alpine => No => Pest
```

=> ファイルありませんエラー発生

  対応:

  ```bash
  # vendorをまっさらに
  rm -rf vendor
  rm composer.lock

  # Composerをクリーンに実行
  composer clear-cache
  composer install
  ```

=> この後もっかい`Breeze`導入

## npm

```
npm install
npm run dev
```

## migration

```
php artisan migrate
```

