<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Application\ViewLoadLog;

use Ngmy\OkuribitoLaravel\Application\ViewLoadLog\ViewLoadLogService;
use Ngmy\OkuribitoLaravel\Domain\Model\View\PathNormalizer;
use Ngmy\OkuribitoLaravel\Domain\Model\View\View;
use Ngmy\OkuribitoLaravel\Domain\Model\View\ViewFactory;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface;
use Ngmy\OkuribitoLaravel\Domain\Service\Config\ConfigServiceInterface;
use Ngmy\OkuribitoLaravel\Tests\TestCase;
use Mockery;

class ViewLoadLogServiceTest extends TestCase
{
    public function recordProvider(): array
    {
        return [
            'is_exclude is true' => [
                'is_exclude' => true,
                'is_already_loaded' => false,
            ],
            'is_already_loaded is true' => [
                'is_exclude' => false,
                'is_already_loaded' => true,
            ],
            'is_exclude and is_already_loaded are false' => [
                'is_exclude' => false,
                'is_already_loaded' => false,
            ],
        ];
    }

    /**
     * @dataProvider recordProvider
     */
    public function testRecord(bool $isExclude, bool $isAlreadyLoaded): void
    {
        $makeView = function (bool $isExclude, bool $isAlreadyLoaded) {
            $mock = Mockery::mock(View::class);
            $mock->shouldReceive('isExclude')->andReturn($isExclude);
            $mock->shouldReceive('isAlreadyLoaded')->andReturn($isAlreadyLoaded);
            return $mock;
        };
        $makeConfigService = function () {
            $mock = Mockery::mock(ConfigServiceInterface::class);
            return $mock;
        };
        $makeViewLoadLogRepository = function () {
            $mock = Mockery::mock(ViewLoadLogRepositoryInterface::class);
            $mock->shouldReceive('save');
            return $mock;
        };
        $makeViewFactory = function (View $view) {
            $mock = Mockery::mock(ViewFactory::class);
            $mock->shouldReceive('createNormalizedPathView')->andReturn($view);
            return $mock;
        };

        $viewLoadLogService = new ViewLoadLogService(
            $makeViewLoadLogRepository(),
            $makeConfigService(),
            new PathNormalizer(),
            $makeViewFactory($makeView($isExclude, $isAlreadyLoaded))
        );

        $viewLoadLogService->record('name', 'path');

        $this->assertTrue(true);
    }
}
