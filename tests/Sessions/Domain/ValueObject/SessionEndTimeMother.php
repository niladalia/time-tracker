<?php

namespace App\Tests\Sessions\Domain\ValueObject;

use App\Sessions\Domain\ValueObject\SessionEndTime;
use DateTime;
class SessionEndTimeMother
{
    public static function create(DateTime $value = null): SessionEndTime
    {
        return new SessionEndTime($value);
    }

    public static function now(): SessionEndTime
    {
        $now = new DateTime();
        $now->setTime(
            $now->format('H'),
            $now->format('i'),
            $now->format('s')
        );
        return self::create($now);
    }
}
