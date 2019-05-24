<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\View;

use Ngmy\OkuribitoLaravel\Domain\Model\AbstractValueObject;

class Name extends AbstractValueObject
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
