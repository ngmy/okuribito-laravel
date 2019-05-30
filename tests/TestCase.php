<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests;

use InvalidArgumentException;
use Mockery;
use ReflectionClass;
use Symfony\Component\Filesystem\Filesystem;

class TestCase extends \Orchestra\Testbench\TestCase
{
    private const VIEW_DIR = __DIR__ . '/data/views';

    private $fileSystem;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->fileSystem = new FileSystem();
    }

    protected function getViewPathFull(string $view): string
    {
        $fullPath = realpath($this->getViewPath($view));
        if (!$fullPath) {
            throw new InvalidArgumentException(sprintf('Specified view "%s" does not exist.', $view));
        }
        return $fullPath;
    }

    protected function getViewPathRedundant(string $view): string
    {
        $reflector = new ReflectionClass(get_class($this));
        /** @var string $fileName */
        $fileName = $reflector->getFileName();
        $dirName = dirname($fileName);
        $relativePath = $this->fileSystem->makePathRelative(self::VIEW_DIR, $dirName);
        return $dirName . '/' . $relativePath . $view;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    private function getViewPath(string $view): string
    {
        return self::VIEW_DIR . '/' . $view;
    }
}
