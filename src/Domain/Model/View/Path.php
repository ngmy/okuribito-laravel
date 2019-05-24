<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\View;

use Ngmy\OkuribitoLaravel\Domain\Model\AbstractValueObject;

class Path extends AbstractValueObject
{
    private $value;

    public static function normalized(PathNormalizer $normalizer, string $value): self
    {
        return $normalizer->createNormalizedPath($value);
    }

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
