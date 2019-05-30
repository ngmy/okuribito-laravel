<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Infrastructure;

use Ngmy\OkuribitoLaravel\Domain\Service\Config\ConfigServiceInterface;

class LaravelConfigService implements ConfigServiceInterface
{
    public function get(string $key)
    {
        return config($key);
    }
}
