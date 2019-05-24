<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\View;

use InvalidArgumentException;

class PathNormalizer
{
    public function createNormalizedPath(string $path): Path
    {
        $normalizedValue = $this->normalizePath($path);
        return new Path($normalizedValue);
    }

    public function normalizePath(string $path): string
    {
        $normalizedPath = realpath($path);
        if (!$normalizedPath) {
            throw new InvalidArgumentException(sprintf('Specified path "%s" does not exist.', $path));
        }
        return $normalizedPath;
    }
}
