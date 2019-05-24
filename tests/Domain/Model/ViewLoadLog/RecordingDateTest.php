<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\ViewLoadLog;

use DateTimeImmutable;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\RecordingDate;
use Ngmy\OkuribitoLaravel\Tests\TestCase;

class RecordingDateTest extends TestCase
{
    public function equalsProvider(): array
    {
        return [
            'value1 and value2 are equal' => [
                'value1' => new DateTimeImmutable('2019-05-27 00:00:00'),
                'value2' => new DateTimeImmutable('2019-05-27 00:00:00'),
                'expected_result' => true,
            ],
            'value1 and value2 are not equal' => [
                'value1' => new DateTimeImmutable('2019-05-27 00:00:00'),
                'value2' => new DateTimeImmutable('2019-05-27 00:00:01'),
                'expected_result' => false,
            ],
        ];
    }

    /**
     * @dataProvider equalsProvider
     */
    public function testEquals(DateTimeImmutable $value1, DateTimeImmutable $value2, bool $expectedResult): void
    {
        $recordingDate1 = new RecordingDate($value1);
        $recordingDate2 = new RecordingDate($value2);

        $actualResult = $recordingDate1->equals($recordingDate2);

        $this->assertEquals($expectedResult, $actualResult);
    }
}
