<?php

namespace App\Tests\Tasks\Domain;

use App\Tasks\Domain\Task;
use App\Tasks\Domain\ValueObject\TaskId;
use App\Tasks\Domain\ValueObject\TaskName;
use App\Tests\Tasks\Domain\ValueObject\TaskIdMother;
use App\Tests\Tasks\Domain\ValueObject\TaskNameMother;

class TaskMother
{
    public static function create(
        ?TaskId $id = null,
        ?TaskName $name = null
    ){
        return new Task(
            $id ?? TaskIdMother::create(),
            $name ?? TaskNameMother::create()
        );
    }
}
