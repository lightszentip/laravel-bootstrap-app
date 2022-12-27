# Development

## DOC

### laravel-model-doc
````
composer require romanzipp/laravel-model-doc --dev
php artisan vendor:publish --provider="romanzipp\ModelDoc\Providers\ModelDocServiceProvider"
````

````shell
php artisan model-doc:generate
````

### Integration Jetbrains

````shell
php artisan ide-helper:generate
php artisan ide-helper:models
# direct to model files
php artisan ide-helper:models -W

````

## Quality

### PHP Coding Standards Fixer
``composer require --dev  friendsofphp/php-cs-fixer``

````shell
vendor/bin/php-cs-fixer fix src
```` 

### PHPStan

For LAravel: composer require nunomaduro/larastan:^2.0 --dev

https://github.com/nunomaduro/larastan

````composer require --dev phpstan/phpstan````

````shell
vendor/bin/phpstan analyse src tests
````

### PHPSta

````shell
composer require --dev phpstan/extension-installer
composer require --dev phpat/phpat
````

https://github.com/carlosas/phpat

## Test data

### Alice

https://github.com/nelmio/alice

````composer require --dev nelmio/alice````

## Analyse

### PHPloc

composer require --dev phploc/phploc

Usage:

````shell
php .\vendor\phploc\phploc\phploc src
````


### PHPcd

````shell
composer require --dev sebastian/phpcpd
````

Usage:

````shell
php .\vendor\sebastian\phpcpd\phpcpd src 
````

### Checkstyle

https://github.com/PHPCheckstyle/phpcheckstyle

````shell
composer require --dev phpcheckstyle/phpcheckstyle
````

Usage:

````shell
 php .\vendor\phpcheckstyle\phpcheckstyle\run.php --src .\src\
 php .\vendor\phpcheckstyle\phpcheckstyle\run.php --src .\src\ --format html --outdir ./build/style-report
````

### PSALM

https://github.com/vimeo/psalm

````shell
composer require --dev vimeo/psalm
./vendor/bin/psalm --init
````

Usage:

````shell
./vendor/bin/psalm
````

### DEPTrac

````shell
https://github.com/qossmic/deptrac
````

### PHPMD

````shell
composer require --dev phpmd/phpmd
````

````shell
php .\vendor\phpmd\phpmd\src\bin\phpmd ./app/ html .\rulesets\codesize.xml --reportfile phpmd.html 
````

#### Plugins

https://psalm.dev/plugins

````shell
composer require --dev psalm/plugin-laravel && vendor/bin/psalm-plugin enable psalm/plugin-laravel
composer require --dev psalm/plugin-phpunit && vendor/bin/psalm-plugin enable psalm/plugin-phpunit
````

## Other

https://github.com/phpro/grumphp

https://github.com/squizlabs/PHP_CodeSniffer

### Autogenerate

#### CRUD Generator

````shell
composer require mrdebug/crudgen --dev
composer require laravelcollective/html

#php artisan make:crud nameOfYourCrud "column1:type, column2"
php artisan make:crud post "title:string, content:text"
````

more see https://github.com/misterdebug/crud-generator-laravel

### Security
https://github.com/GrahamCampbell/Laravel-Security
