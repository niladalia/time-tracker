<?php

namespace App\Tests\Tasks\Domain\ValueObject;

use App\Shared\Domain\ValueObject\Uuid;
use App\Tasks\Domain\ValueObject\TaskId;

class TaskIdMother
{
    public static function create(?string $value = null): TaskId
    {
        return new TaskId($value ? Uuid::fromString($value) : Uuid::generate());
    }
}
