<?php

namespace App\Tests\Tasks\Application\Create;

use App\Shared\Domain\ValueObject\Uuid;
use App\Tasks\Application\Create\TaskCreator;
use App\Tasks\Application\Find\TaskFinder;
use App\Tasks\Domain\Task;
use App\Tests\Shared\Domain\UuidMother;
use App\Tests\Tasks\Domain\TaskMother;
use App\Tests\Tasks\Domain\ValueObject\TaskIdMother;
use App\Tests\Tasks\Domain\ValueObject\TaskNameMother;
use App\Tests\Tasks\TaskUnitTestCase;

class TaskCreatorUnitTest extends TaskUnitTestCase
{
    private TaskCreator $taskCreator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskCreator = new TaskCreator($this->repository());
    }

    public function testItCreatesATask(): void
    {
        $taskName = TaskNameMother::create();
        $taskId = TaskIdMother::create();

        $task = TaskMother::create($taskId, $taskName);

        $this->shouldSave($task);

        $createdTask = $this->taskCreator->__invoke($taskName);

        $this->assertEquals($task, $createdTask);
    }


}
