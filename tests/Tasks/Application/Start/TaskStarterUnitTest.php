<?php

namespace App\Tests\Tasks\Application\Start;

use App\Sessions\Application\Create\DTO\CreateSessionRequest;
use App\Sessions\Application\Create\SessionCreator;
use App\Tasks\Application\Start\TaskStarter;
use App\Tasks\Domain\Exceptions\TaskHasOpenSessionsException;
use App\Tasks\Domain\Task;
use App\Tests\Sessions\Domain\SessionMother;
use App\Tests\Tasks\Domain\TaskMother;
use App\Tests\Tasks\Domain\ValueObject\TaskStartTimeMother;
use PHPUnit\Framework\TestCase;

class TaskStarterUnitTest extends TestCase
{
    private TaskStarter $taskStarter;
    private $sessionCreator;

    protected function setUp(): void
    {
        $this->sessionCreator = $this->createMock(SessionCreator::class);
        $this->taskStarter = new TaskStarter($this->sessionCreator);
    }

    public function testItStartsATaskWithNoOpenSession(): void
    {
        $task = TaskMother::create();
        $startTime = TaskStartTimeMother::now();

        $this->sessionCreator
            ->expects($this->once())
            ->method('__invoke')
            ->with(new CreateSessionRequest($task->id()->getValue(), $startTime->getValue()));

        $this->taskStarter->__invoke($task, $startTime);

        $this->assertTrue(true);
    }

    public function testItThrowsExceptionWhenTaskHasOpenSession(): void
    {
        $task = TaskMother::create();

        SessionMother::create($task);

        $startTime = TaskStartTimeMother::now();

        $this->expectException(TaskHasOpenSessionsException::class);

        $this->taskStarter->__invoke($task, $startTime);

    }
}
