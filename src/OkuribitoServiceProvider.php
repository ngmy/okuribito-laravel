<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel;

use Illuminate\Support\ServiceProvider;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface;
use Ngmy\OkuribitoLaravel\Domain\Service\Config\ConfigServiceInterface;
use Ngmy\OkuribitoLaravel\Infrastructure\DbViewLoadLogRepository;
use Ngmy\OkuribitoLaravel\Infrastructure\LaravelConfigService;

class OkuribitoServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $configPath = __DIR__ . '/../config/ngmy-okuribito-laravel.php';
        $this->mergeConfigFrom($configPath, 'ngmy-okuribito-laravel');
        $this->publishes([$configPath => config_path('ngmy-okuribito-laravel.php')], 'ngmy-okuribito-laravel');

        $migrationsPath = __DIR__ . '/../database/migrations';
        $this->loadMigrationsFrom($migrationsPath);
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->bind(ViewLoadLogRepositoryInterface::class, DbViewLoadLogRepository::class);
        $this->app->bind(ConfigServiceInterface::class, LaravelConfigService::class);
    }
}
