<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Tests\Domain\Model\ViewLoadLog;

use DateTimeImmutable;
use Ngmy\OkuribitoLaravel\Domain\Model\View\Name;
use Ngmy\OkuribitoLaravel\Domain\Model\View\Path;
use Ngmy\OkuribitoLaravel\Domain\Model\View\View;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\RecordingDate;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLog;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogId;
use Ngmy\OkuribitoLaravel\Tests\TestCase;
use stdClass;

class ViewLoadLogTest extends TestCase
{
    public function equalsProvider(): array
    {
        return [
            'view_load_log_id1 and view_load_log_id2 are equal' => [
                'view_load_log_id1' => 1,
                'view_load_log_id2' => 1,
                'expected_result' => true,
                'other_type_opponent' => false,
            ],
            'view_load_log_id1 and view_load_log_id2 are not equal' => [
                'view_load_log_id1' => 1,
                'view_load_log_id2' => 2,
                'expected_result' => false,
                'other_type_opponent' => false,
            ],
            'view_load_log_id1 is ViewLoadLogId and view_load_log_id2 are not ViewLoadLogId' => [
                'view_load_log_id1' => 1,
                'view_load_log_id2' => 1,
                'expected_result' => false,
                'other_type_opponent' => true,
            ],
        ];
    }

    /**
     * @dataProvider equalsProvider
     */
    public function testEquals(
        ?int $viewLoadLogId1,
        ?int $viewLoadLogId2,
        bool $expectedResult,
        bool $otherTypeOpponent
    ): void {
        $viewLoadLog1 = new ViewLoadLog(
            new ViewLoadLogId($viewLoadLogId1),
            new View(new Name('name'), new Path('path')),
            RecordingDate::current()
        );

        if ($otherTypeOpponent) {
            $viewLoadLog2 = new stdClass();
        } else {
            $viewLoadLog2 = new ViewLoadLog(
                new ViewLoadLogId($viewLoadLogId2),
                new View(new Name('name'), new Path('path')),
                RecordingDate::current()
            );
        }

        $actualResult = $viewLoadLog1->equals($viewLoadLog2);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testToArray(): void
    {
        $viewLoadLog1 = new ViewLoadLog(
            new ViewLoadLogId(1),
            new View(new Name('name'), new Path('path')),
            new RecordingDate(new DateTimeImmutable('2019-05-27 00:00:00'))
        );

        $expectedResult = [
            'view_load_log_id' => 1,
            'view_name' => 'name',
            'view_path' => 'path',
            'recording_date' => new DateTimeImmutable('2019-05-27 00:00:00'),
        ];

        $actualResult = $viewLoadLog1->toArray();

        $this->assertEquals($expectedResult, $actualResult);
    }
}
