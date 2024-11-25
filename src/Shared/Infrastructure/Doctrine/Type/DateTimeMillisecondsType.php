<?php

namespace App\Shared\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;

class DateTimeMillisecondsType extends DateTimeType
{
    public const NAME = 'datetime_milliseconds';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d H:i:s.u'); // Include milliseconds
        }
        return null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value !== null ? \DateTime::createFromFormat('Y-m-d H:i:s.u', $value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return 'DATETIME(3)';
    }
}
