<?php

namespace App\Tests\Sessions\Application\Create;

use App\Sessions\Application\Create\DTO\CreateSessionRequest;
use App\Sessions\Application\Create\SessionCreator;
use App\Tasks\Application\Find\TaskFinder;
use App\Tests\Sessions\Domain\SessionMother;
use App\Tests\Sessions\SessionUnitTestCase;
use App\Tests\Tasks\Domain\TaskMother;

class SessionCreatorUnitTest extends SessionUnitTestCase
{
    private SessionCreator $sessionCreator;
    private TaskFinder $taskFinder;
    protected function setUp(): void
    {
        parent::setUp();
        $this->taskFinder = $this->createMock(TaskFinder::class);

        // Instantiate the class to be tested
        $this->sessionCreator = new SessionCreator(
            $this->repository(),
            $this->taskFinder
        );
    }

    public function testItCreatesASession(): void
    {
        $task = TaskMother::create();

        $session = SessionMother::create($task);

        $this->taskFinder
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->equalTo($task->id()))
            ->willReturn($task);

        $sessionRequest = new CreateSessionRequest($task->id(), $session->startTime()->getValue());

        $this->shouldSave($session);

        $this->sessionCreator->__invoke($sessionRequest);
    }

}
