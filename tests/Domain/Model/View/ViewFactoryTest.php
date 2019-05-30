<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\View;

use Ngmy\OkuribitoLaravel\Domain\Model\View\Name;
use Ngmy\OkuribitoLaravel\Domain\Model\View\Path;
use Ngmy\OkuribitoLaravel\Domain\Model\View\PathNormalizer;
use Ngmy\OkuribitoLaravel\Domain\Model\View\View;
use Ngmy\OkuribitoLaravel\Domain\Model\View\ViewFactory;
use Ngmy\OkuribitoLaravel\Tests\TestCase;

class ViewFactoryTest extends TestCase
{
    public function testCreateNormalizedPathView(): void
    {
        $viewFactory = new ViewFactory();

        $expectedResult = new View(
            new Name('name'),
            new Path($this->getViewPathFull('test1.blade.php'))
        );

        $actualResult = $viewFactory->createNormalizedPathView(
            new PathNormalizer(),
            'name',
            $this->getViewPathRedundant('test1.blade.php')
        );

        $this->assertEquals($expectedResult, $actualResult);
    }
}
