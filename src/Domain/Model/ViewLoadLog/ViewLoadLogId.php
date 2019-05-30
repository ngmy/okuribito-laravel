<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog;

use Ngmy\OkuribitoLaravel\Domain\Model\AbstractValueObject;

class ViewLoadLogId extends AbstractValueObject
{
    private $value;

    public static function null(): self
    {
        return new self(null);
    }

    public function __construct(?int $value)
    {
        $this->value = $value;
    }

    public function value(): ?int
    {
        return $this->value;
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
