<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\View;

use Ngmy\OkuribitoLaravel\Domain\Model\View\Path;
use Ngmy\OkuribitoLaravel\Tests\TestCase;

class PathTest extends TestCase
{
    public function equalsProvider(): array
    {
        return [
            'value1 and value2 are equal' => [
                'value1' => 'path1',
                'value2' => 'path1',
                'expected_result' => true,
            ],
            'value1 and value2 are not equal' => [
                'value1' => 'path1',
                'value2' => 'path2',
                'expected_result' => false,
            ],
        ];
    }

    /**
     * @dataProvider equalsProvider
     */
    public function testEquals(string $value1, string $value2, bool $expectedResult): void
    {
        $path1 = new Path($value1);
        $path2 = new Path($value2);

        $actualResult = $path1->equals($path2);

        $this->assertEquals($expectedResult, $actualResult);
    }
}
