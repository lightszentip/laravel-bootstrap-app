# laravel-boostrap
A laravel bootstrap template with jetstream

[![SL Scan](https://github.com/lightszentip/laravel-boostrap/actions/workflows/shiftleft.yml/badge.svg?branch=main)](https://github.com/lightszentip/laravel-boostrap/actions/workflows/shiftleft.yml)

[toc]

## First Setup

````shell
cp .env.example .env
php artisan key:generate 
npm run install
composer install
````

## Setup Database

For SQL Lite edit the .env:

````text
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
SESSION_DRIVER=file
````

## Start


````markdown
npm run dev
php artisan serve
````
