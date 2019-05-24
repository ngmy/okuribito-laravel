<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\ViewLoadLog;

use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogId;
use Ngmy\OkuribitoLaravel\Tests\TestCase;

class ViewLoadLogIdTest extends TestCase
{
    public function equalsProvider(): array
    {
        return [
            'value1 and value2 are equal' => [
                'value1' => 1,
                'value2' => 1,
                'expected_result' => true,
            ],
            'value1 and value2 are not equal' => [
                'value1' => 1,
                'value2' => 2,
                'expected_result' => false,
            ],
            'value1 is int and value2 is null' => [
                'value1' => 1,
                'value2' => null,
                'expected_result' => false,
            ],
            'value1 and value2 are null' => [
                'value1' => null,
                'value2' => null,
                'expected_result' => true,
            ],
        ];
    }

    /**
     * @dataProvider equalsProvider
     */
    public function testEquals(?int $value1, ?int $value2, bool $expectedResult): void
    {
        $viewLoadLogId1 = new ViewLoadLogId($value1);
        $viewLoadLogId2 = new ViewLoadLogId($value2);

        $actualResult = $viewLoadLogId1->equals($viewLoadLogId2);

        $this->assertEquals($expectedResult, $actualResult);
    }
}
