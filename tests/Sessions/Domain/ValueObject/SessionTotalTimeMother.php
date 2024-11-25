<?php

namespace App\Tests\Sessions\Domain\ValueObject;

use App\Sessions\Domain\ValueObject\SessionTotalTime;

class SessionTotalTimeMother
{
    public static function create(float $value = null): SessionTotalTime
    {
        return new SessionTotalTime($value);
    }

}
