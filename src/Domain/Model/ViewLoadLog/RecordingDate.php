<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog;

use Ngmy\OkuribitoLaravel\Domain\Model\AbstractValueObject;
use DateTimeImmutable;

class RecordingDate extends AbstractValueObject
{
    private $value;

    public static function current(): self
    {
        return new self(new DateTimeImmutable());
    }

    public function __construct(DateTimeImmutable $value)
    {
        $this->value = $value;
    }

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
