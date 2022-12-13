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
php artisan migrate
php artisan serve
````


## Functions
* Version Handling - see https://github.com/antonioribeiro/version
* Role And Permission - see https://github.com/spatie/laravel-permission


### Role and Permission Handling

see [Role And Permission Documentation](doc/role_and_permission.md)

### Version Handling

see [Version Handling](doc/version_handling.md)

## Changelog

````shell
php artisan changelog:add => Add a new item for changelog
php artisan changelog:release => Release a new version with use the current version from version plugin
````

### Release

````shell
php artisan changelog:release

 type:
 > minor

 releasename:
 > Init Release

````

type: rc, patch, minor, major

