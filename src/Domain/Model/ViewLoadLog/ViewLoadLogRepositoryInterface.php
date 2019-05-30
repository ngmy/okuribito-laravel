<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog;

use Ngmy\OkuribitoLaravel\Domain\Model\View\View;

interface ViewLoadLogRepositoryInterface
{
    public function existsByView(View $view): bool;

    public function save(ViewLoadLog $log): void;
}
