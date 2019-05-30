<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Service\Config;

interface ConfigServiceInterface
{
    public function get(string $key);
}
