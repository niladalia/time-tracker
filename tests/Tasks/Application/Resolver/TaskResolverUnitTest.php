<?php

namespace App\Tests\Tasks\Application\Resolver;

use App\Tasks\Application\Create\TaskCreator;
use App\Tasks\Application\Find\TaskFindByName;
use App\Tasks\Application\Resolver\TaskResolver;
use App\Tests\Tasks\Domain\TaskMother;
use App\Tests\Tasks\Domain\ValueObject\TaskIdMother;
use App\Tests\Tasks\Domain\ValueObject\TaskNameMother;
use App\Tests\Tasks\TaskUnitTestCase;

class TaskResolverUnitTest extends TaskUnitTestCase
{
    private TaskResolver $taskResolver;
    private TaskFindByName $taskFindByName;
    private TaskCreator $taskCreator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskFindByName = $this->createMock(TaskFindByName::class);
        $this->taskCreator = $this->createMock(TaskCreator::class);

        $this->taskResolver = new TaskResolver(
            $this->taskFindByName,
            $this->taskCreator,
        );
    }

    public function testItFindsAnExistingTask(): void
    {
        $taskName = TaskNameMother::create();
        $existingTask = TaskMother::create(TaskIdMother::create(), $taskName);

        $this->taskFindByName
            ->expects($this->once())
            ->method('__invoke')
            ->with($taskName)
            ->willReturn($existingTask);

        $this->taskCreator
            ->expects($this->never())
            ->method('__invoke');

        $resolvedTask = $this->taskResolver->__invoke($taskName);

        $this->assertEquals($existingTask, $resolvedTask);
    }

    public function testItCreatesANewTaskIfNotFound(): void
    {
        $taskName = TaskNameMother::create();
        $newTask = TaskMother::create(TaskIdMother::create(), $taskName);

        $this->taskFindByName
            ->expects($this->once())
            ->method('__invoke')
            ->with($taskName)
            ->willReturn(null);

        $this->taskCreator
            ->expects($this->once())
            ->method('__invoke')
            ->with($taskName)
            ->willReturn($newTask);

        $resolvedTask = $this->taskResolver->__invoke($taskName);

        $this->assertEquals($newTask, $resolvedTask);
    }
}
