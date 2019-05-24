<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\View;

use Ngmy\OkuribitoLaravel\Domain\Model\View\Name;
use Ngmy\OkuribitoLaravel\Tests\TestCase;

class NameTest extends TestCase
{
    public function equalsProvider(): array
    {
        return [
            'value1 and value2 are equal' => [
                'value1' => 'name1',
                'value2' => 'name1',
                'expected_result' => true,
            ],
            'value1 and value2 are not equal' => [
                'value1' => 'name1',
                'value2' => 'name2',
                'expected_result' => false,
            ],
        ];
    }

    /**
     * @dataProvider equalsProvider
     */
    public function testEquals(string $value1, string $value2, bool $expectedResult): void
    {
        $name1 = new Name($value1);
        $name2 = new Name($value2);

        $actualResult = $name1->equals($name2);

        $this->assertEquals($expectedResult, $actualResult);
    }
}
