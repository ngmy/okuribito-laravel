<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $monitorViews = config('ngmy-okuribito-laravel.monitor_views');
        if (!empty($monitorViews)) {
            View::composer($monitorViews, OkuribitoComposer::class);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        //
    }
}
