<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\View;

use Mockery;
use Ngmy\OkuribitoLaravel\Domain\Model\View\Name;
use Ngmy\OkuribitoLaravel\Domain\Model\View\Path;
use Ngmy\OkuribitoLaravel\Domain\Model\View\View;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface;
use Ngmy\OkuribitoLaravel\Domain\Service\Config\ConfigServiceInterface;
use Ngmy\OkuribitoLaravel\Tests\TestCase;
use stdClass;

class ViewTest extends TestCase
{
    public function isExcludeProvider(): array
    {
        return [
            'path is included in exclude_files' => [
                'path' => 'path',
                'exclude_files' => [
                    'path',
                ],
                'expected_result' => true,
            ],
            'path is not included in exclude_files' => [
                'path' => 'path',
                'exclude_files' => [],
                'expected_result' => false,
            ],
        ];
    }

    /**
     * @dataProvider isExcludeProvider
     */
    public function testIsExclude(string $path, array $excludeFiles, bool $expectedResult): void
    {
        $newConfigService = function (array $excludeFiles) {
            $mock = Mockery::mock(ConfigServiceInterface::class);
            $mock->shouldReceive('get')->andReturn($excludeFiles);
            return $mock;
        };

        $view = new View(
            new Name('name'),
            new Path($path)
        );

        $actualResult = $view->isExclude($newConfigService($excludeFiles));

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function isAlreadyLoadedProvider(): array
    {
        return [
            'record_once and exists_by_view is true' => [
                'record_once' => true,
                'exists_by_view' => true,
                'expected_result' => true,
            ],
            'record_once is true and exists_by_view is false' => [
                'record_once' => true,
                'exists_by_view' => false,
                'expected_result' => false,
            ],
            'record_once is false' => [
                'record_once' => false,
                'exists_by_view' => false,
                'expected_result' => false,
            ],
        ];
    }

    /**
     * @dataProvider isAlreadyLoadedProvider
     */
    public function testIsAlreadyLoaded(bool $recordOnce, bool $existsByView, bool $expectedResult): void
    {
        $newConfigService = function (bool $recordOnce) {
            $mock = Mockery::mock(ConfigServiceInterface::class);
            $mock->shouldReceive('get')->andReturn($recordOnce);
            return $mock;
        };
        $newViewLoadLogRepository = function (bool $existsByView) {
            $mock = Mockery::mock(ViewLoadLogRepositoryInterface::class);
            $mock->shouldReceive('existsByView')->andReturn($existsByView);
            return $mock;
        };

        $view = new View(
            new Name('name'),
            new Path('path')
        );

        $actualResult = $view->isAlreadyLoaded(
            $newViewLoadLogRepository($existsByView),
            $newConfigService($recordOnce)
        );

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function equalsProvider(): array
    {
        return [
            'path1 and path2 are equal' => [
                'path1' => 'path1',
                'path2' => 'path1',
                'expected_result' => true,
                'other_type_opponent' => false,
            ],
            'path1 and path2 are not equal' => [
                'path1' => 'path1',
                'path2' => 'path2',
                'expected_result' => false,
                'other_type_opponent' => false,
            ],
            'path1 is Path and path2 are not Path' => [
                'path1' => 'path1',
                'path2' => 'path1',
                'expected_result' => false,
                'other_type_opponent' => true,
            ],
        ];
    }

    /**
     * @dataProvider equalsProvider
     */
    public function testEquals(string $path1, string $path2, bool $expectedResult, bool $otherTypeOpponent): void
    {
        $view1 = new View(
            new Name('name'),
            new Path($path1)
        );

        if ($otherTypeOpponent) {
            $view2 = new stdClass();
        } else {
            $view2 = new View(
                new Name('name'),
                new Path($path2)
            );
        }

        $actualResult = $view1->equals($view2);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testToArray(): void
    {
        $view = new View(
            new Name('name'),
            new Path('path')
        );

        $expectedResult = [
            'name' => 'name',
            'path' => 'path',
        ];

        $actualResult = $view->toArray();

        $this->assertEquals($expectedResult, $actualResult);
    }
}
