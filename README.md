# FashionableLate

# 環境構築

## Dockerビルド
* git clone
* docker compose up -d --build

## Laravel環境構築
* docker compose exec php bash
* composer install
* php artisan key:generate
* php artisan migrate
* php artisan db:seed --class=CategoryTableSeeder
* php artisan db:seed --class=ContactTableSeeder

# 開発環境

* お問い合わせ画面：<http://localhost/>
* ユーザー登録： <http://localhost/register>
* phpMyAdmin：<http://localhost:8080/>

# 使用技術（実行環境）

* PHP 8.1.33
* Laravel 8.83.29
* MySQL 11.8.3
* nginx 1.12.1

# ER図
