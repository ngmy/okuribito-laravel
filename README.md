# OkuribitoLaravel

[![Build Status](https://travis-ci.org/ngmy/okuribito-laravel.svg?branch=master)](https://travis-ci.org/ngmy/okuribito-laravel)
[![Coverage Status](https://coveralls.io/repos/github/ngmy/okuribito-laravel/badge.svg?branch=master)](https://coveralls.io/github/ngmy/okuribito-laravel?branch=master)

OkuribitoLaravel can monitor view loading and record it. This helps to remove unused view files.

This package is inspired by [Ruby's Okuribito gem](https://github.com/shakemurasan/okuribito).

## Requirements

OkuribitoLaravel has the following requirements:

* PHP >= 7.1.3
* Laravel >= 5.5

## Installation

Execute the `require` Composer command:

```
composer require ngmy/okuribito-laravel
```

This will update your `composer.json` file and install this package into the `vendor` directory.

### Migration

Execute the `migrate` Artisan command:

```
php artisan migrate
```

This will create the `view_load_logs` table in your database.

### Publishing Configuration

Execute the `vendor:publish` Artisan command:

```
php artisan vendor:publish
```

This will publish the configuration file to the `config/ngmy-okuribito-laravel.php` file.

You can also use the tag to execute the command:

```
php artisan vendor:publish --tag=ngmy-okuribito-laravel
```

You can also use the service provider to execute the command:

```
php artisan vendor:publish --provider="Ngmy\OkuribitoLaravel\OkuribitoServiceProvider"
```

## Basic Usage

Update the `config/ngmy-okuribito-laravel.php` file's `monitor_views` option to the view you want to monitor loading:

```php
'monitor_views' => 'your.view.foo',
```

You can also specify multiple views:

```php
'monitor_views' => [
    'your.view.bar',
    'your.view.baz',
],
```

You can also use a wildcard:

```php
'monitor_views' => 'your.view.*',
```

This value is specified in the same format as the first argument of [Laravel's `View::composer` method](https://laravel.com/docs/5.5/views#view-composers).

When the specified view is loaded, it is recorded to the `view_load_logs` table in your database.

You have other options available. See the `config/ngmy-okuribito-laravel.php` file for details.

## Advanced Usage

### Customizing Record Method

Creating your implementation of the `ViewLoadLogRepositoryInterface` interface.

```php
<?php
declare(strict_types=1);

namespace Your\Namespace;

use Ngmy\OkuribitoLaravel\Domain\Model\View\View;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLog;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface;

class YourViewLoadLogRepository implements ViewLoadLogRepositoryInterface
{
    public function existsByView(View $view): bool
    {
        // Implement your existsByView() method here
    }

    public function save(ViewLoadLog $log): void
    {
        // Implement your save() method here
    }
}
```

Binding the `ViewLoadLogRepositoryInterface` interface to your implementation in your service provider's `register` method.

```php
$this->app->bind(
    \Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface::class,
    \Your\Namespace\YourViewLoadLogRepository::class
);
```

## License

OkuribitoLaravel is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
