<?php

namespace App\Tests\Tasks\Domain\ValueObject;

use App\Tasks\Domain\ValueObject\TaskStartTime;
use DateTime;
class TaskStartTimeMother
{
    public static function create(DateTime $value = null): TaskStartTime
    {
        return new TaskStartTime($value);
    }

    public static function now(): TaskStartTime
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
