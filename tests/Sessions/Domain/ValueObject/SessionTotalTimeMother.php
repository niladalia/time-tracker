<?php

namespace App\Tests\Sessions\Domain\ValueObject;

use App\Sessions\Domain\ValueObject\SessionStartTime;
use App\Sessions\Domain\ValueObject\SessionTotalTime;
use App\Tasks\Domain\ValueObject\TaskStartTime;
use DateTime;
class SessionTotalTimeMother
{
    public static function create(float $value = null): SessionTotalTime
    {
        return new SessionTotalTime($value);
    }

}
