<?php

namespace App\Tests\Tasks\Domain\ValueObject;

use App\Tasks\Domain\ValueObject\TaskName;
use Faker\Factory;

class TaskNameMother
{
    public static function create(?string $value = null): TaskName
    {
        return new TaskName($value ?? Factory::create()->text(20));
    }
}
