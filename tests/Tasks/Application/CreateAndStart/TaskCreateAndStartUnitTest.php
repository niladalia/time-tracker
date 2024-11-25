<?php

namespace App\Tests\Tasks\Application\CreateAndStart;

use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartRequest;
use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartResponse;
use App\Tasks\Application\CreateAndStart\TaskCreateAndStart;
use App\Tasks\Application\Resolver\TaskResolver;
use App\Tasks\Application\Start\TaskStarter;
use App\Tests\Tasks\Domain\TaskMother;
use App\Tests\Tasks\Domain\ValueObject\TaskIdMother;
use App\Tests\Tasks\Domain\ValueObject\TaskNameMother;
use App\Tests\Tasks\Domain\ValueObject\TaskStartTimeMother;
use App\Tests\Tasks\TaskUnitTestCase;

class TaskCreateAndStartUnitTest extends TaskUnitTestCase
{
    private TaskCreateAndStart $service;
    private TaskResolver $taskResolver;
    private TaskStarter $taskStarter;
    protected function setUp(): void
    {
        parent::setUp();

        $this->taskResolver = $this->createMock(TaskResolver::class);
        $this->taskStarter = $this->createMock(TaskStarter::class);

        $this->service = new TaskCreateAndStart(
            $this->taskResolver,
            $this->taskStarter,
        );

    }

    public function testItCreatesAndStartsATask(): void
    {
        $taskName = TaskNameMother::create();
        $startTime = TaskStartTimeMother::now();
        $task = TaskMother::create(TaskIdMother::create(), $taskName);


        $request = new TaskCreateAndStartRequest(
            $taskName->getValue(),
            $startTime->formatISO(),
        );

        $this->taskResolver
            ->expects($this->once())
            ->method('__invoke')
            ->with($taskName)
            ->willReturn($task);

        $this->taskStarter
            ->expects($this->once())
            ->method('__invoke')
            ->with($task, $startTime);

        $response = $this->service->__invoke($request);

        // Assert response
        $this->assertInstanceOf(TaskCreateAndStartResponse::class, $response);
        $this->assertEquals($task->id()->getValue(), $response->id());
        $this->assertEquals($task->totalTime()->getValue(), $response->totalTime());
    }


}
