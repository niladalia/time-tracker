<?php

namespace App\Tasks\Application\Start;

use App\Sessions\Application\Create\DTO\CreateSessionRequest;
use App\Sessions\Application\Create\SessionCreator;
use App\Tasks\Domain\Exceptions\TaskHasOpenSessionsException;
use App\Tasks\Domain\Task;
use App\Tasks\Domain\ValueObject\TaskStartTime;

class TaskStarter
{
    public function __construct(
        private SessionCreator $sessionCreator
    )
    {
    }

    public function __invoke(Task $task, TaskStartTime $startTime): void
    {
        // TODO ALERTA ACOPLAMENT (ACL getOpenSessionsForTaskId)
        if ($task->hasOpenSession()){
            TaskHasOpenSessionsException::throw($task->id());
        }

        // TODO ALERTA ACOPLAMENT (Event de Domini o ACL (interface SessionsAdapterACL createSession() ))
        $this->sessionCreator->__invoke(
            new CreateSessionRequest(
                $task->id()->getValue(),
                $startTime->getValue()
            )
        );
    }
}
