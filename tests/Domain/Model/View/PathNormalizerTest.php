<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\View;

use InvalidArgumentException;
use Ngmy\OkuribitoLaravel\Domain\Model\View\Path;
use Ngmy\OkuribitoLaravel\Domain\Model\View\PathNormalizer;
use Ngmy\OkuribitoLaravel\Tests\TestCase;

class PathNormalizerTest extends TestCase
{
    public function createNormalizedPathProvider(): array
    {
        return [
            'path exists' => [
                'path' => $this->getViewPathRedundant('test1.blade.php'),
                'normalized_path' => $this->getViewPathFull('test1.blade.php'),
            ],
        ];
    }

    /**
     * @dataProvider createNormalizedPathProvider
     */
    public function testCreateNormalizedPath(string $path, string $normalizedPath): void
    {
        $pathNormalizer = new PathNormalizer();

        $expectedResult = new Path($normalizedPath);

        $actualResult = $pathNormalizer->createNormalizedPath($path);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function normalizePathProvider(): array
    {
        return [
            'path exists' => [
                'path' => $this->getViewPathRedundant('test1.blade.php'),
                'expected_result' => $this->getViewPathFull('test1.blade.php'),
            ],
            'path does not exist' => [
                'path' => 'path',
                'expected_result' => null,
            ],
        ];
    }

    /**
     * @dataProvider normalizePathProvider
     */
    public function testNormalizePath(string $path, ?string $expectedResult): void
    {
        $pathNormalizer = new PathNormalizer();

        try {
            $actualResult = $pathNormalizer->normalizePath($path);
        } catch (InvalidArgumentException $e) {
            if (is_null($expectedResult)) {
                $this->assertTrue(true);
            } else {
                $this->fail();
            }
            return;
        }

        $this->assertEquals($expectedResult, $actualResult);
    }
}
