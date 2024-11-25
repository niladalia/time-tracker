<?php

namespace App\Tests\Sessions\Domain\ValueObject;

use App\Sessions\Domain\ValueObject\SessionStartTime;
use App\Tasks\Domain\ValueObject\TaskStartTime;
use DateTime;
class SessionStartTimeMother
{
    public static function create(DateTime $value = null): SessionStartTime
    {
        return new SessionStartTime($value);
    }

    public static function now(): SessionStartTime
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
