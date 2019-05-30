<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel;

use Illuminate\View\View;
use Ngmy\OkuribitoLaravel\Application\ViewLoadLog\ViewLoadLogService;
use Throwable;

class OkuribitoComposer
{
    private $viewLoadLogService;

    public function __construct(ViewLoadLogService $viewLoadLogService)
    {
        $this->viewLoadLogService = $viewLoadLogService;
    }

    public function compose(View $view): void
    {
        try {
            $viewName = $view->getName();
            $viewPath = $view->getPath();

            $this->viewLoadLogService->record($viewName, $viewPath);
        } catch (Throwable $e) {
            if (!config('ngmy-okuribito-laravel.ignore_exception')) {
                throw $e;
            }
        }
    }
}
