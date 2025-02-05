<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Серверная часть проекта интернет-магазина. Практика RedLine.

## Технологии
- Laravel 11
- MySQL 8.0

## Инструкция по запуску

1. Скопируйте файл `.env.example` в `.env`:
    ```bash
    cp .env.example .env
    ```

2. Сделайте сборку контейнеров:
    ```bash
    docker-compose build
    ```

3. Запустите контейнеры:
    ```bash
    docker-compose up -d
    ```

4. Запустите установку зависимостей:
    ```bash
    docker-compose exec backend composer install
    ```
   
5. Запустите миграции:
    ```bash
    docker-compose exec backend php artisan migrate
    ```

6. Запустите сидеры продуктов:
    ```bash
    docker-compose exec backend php artisan db:seed --class=ProductSeeder
    ```
