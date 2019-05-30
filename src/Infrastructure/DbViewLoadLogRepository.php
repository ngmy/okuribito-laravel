<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Infrastructure;

use Ngmy\OkuribitoLaravel\Domain\Model\View\View;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLog;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface;
use Ngmy\OkuribitoLaravel\Infrastructure\Eloquent\ViewLoadLog as EloquentViewLoadLog;

class DbViewLoadLogRepository implements ViewLoadLogRepositoryInterface
{
    public function existsByView(View $view): bool
    {
        $viewValues = $view->toArray();

        return EloquentViewLoadLog::where('view_path', $viewValues['path'])->exists();
    }

    public function save(ViewLoadLog $log): void
    {
        $logValues = $log->toArray();

        $eloquentLog = new EloquentViewLoadLog();
        $eloquentLog->id = $logValues['view_load_log_id'];
        $eloquentLog->view_name = $logValues['view_name'];
        $eloquentLog->view_path = $logValues['view_path'];
        $eloquentLog->recording_date = $logValues['recording_date'];
        $eloquentLog->save();
    }
}
