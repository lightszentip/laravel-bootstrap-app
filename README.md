# laravel-boostrap
A laravel bootstrap template with jetstream

[![SL Scan](https://github.com/lightszentip/laravel-boostrap/actions/workflows/shiftleft.yml/badge.svg?branch=main)](https://github.com/lightszentip/laravel-boostrap/actions/workflows/shiftleft.yml)
[![PHP-Quality](https://github.com/lightszentip/laravel-bootstrap-app/actions/workflows/quality-check.yml/badge.svg)](https://github.com/lightszentip/laravel-bootstrap-app/actions/workflows/quality-check.yml)
[![PHP-LOC and PHPMD](https://github.com/lightszentip/laravel-bootstrap-app/actions/workflows/phploc.yml/badge.svg)](https://github.com/lightszentip/laravel-bootstrap-app/actions/workflows/phploc.yml)

## Versions

| Release   | Laravel                   | PHP     |
|:----------|:--------------------------|:--------|
| **1.2.x** | `10.*`                    | `>=8.1` |
| **1.1.x** | `9.*`                     | `>=8.0` |

## First Setup

````shell
cp .env.example .env
composer install
php artisan key:generate 
npm install
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
* Role And Permission - see https://github.com/spatie/laravel-permission

### Role and Permission Handling

see [Role And Permission Documentation](doc/role_and_permission.md)

### Changelog and Version Handling

see [Version Handling](doc/version_handling.md)

https://github.com/lightszentip/laravel-release-changelog-generator

````shell
php artisan changelog:add => Add a new item for changelog
php artisan changelog:release => Release a new version with use the current version from version plugin
````

#### Release

````shell
php artisan changelog:release

 type:
 > minor

 releasename:
 > Init Release

````

type: rc, patch, minor, major, timestamp

