<?php

namespace App\Shared\Domain\ValueObject;

use DateTime;

abstract class DateTimeValueObject
{
    public function __construct(protected ?DateTime $value = null) {}

    public function getValue(): ?DateTime
    {
        return $this->value;
    }

    public function formatISO(): ?string
    {
        return $this->value?->format(DateTime::ATOM);
    }

    public function getTimestamp(): string
    {
        $this->value->getTimestamp();
    }

    public function formatMilliseconds(): ?float
    {
        if (!$this->value) {
            return null;
        }

        return (float) $this->value->format('U.u'); // 'U.u' provides the timestamp with microseconds as a float
    }
}
