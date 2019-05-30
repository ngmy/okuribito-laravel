<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\View;

class ViewFactory
{
    public function createNormalizedPathView(PathNormalizer $pathNormalizer, string $name, string $path): View
    {
        return new View(
            new Name($name),
            Path::normalized($pathNormalizer, $path)
        );
    }
}
