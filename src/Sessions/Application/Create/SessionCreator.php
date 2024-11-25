<?php

namespace App\Sessions\Application\Create;

use App\Sessions\Application\Create\DTO\CreateSessionRequest;
use App\Sessions\Domain\Session;
use App\Sessions\Domain\SessionRepository;
use App\Sessions\Domain\ValueObject\SessionId;
use App\Sessions\Domain\ValueObject\SessionStartTime;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tasks\Application\Find\TaskFinder;
use App\Tasks\Domain\ValueObject\TaskId;

class SessionCreator
{
    public function __construct(
        private SessionRepository $session_repository,
        private TaskFinder $task_finder,
    ) {}

    public function __invoke(CreateSessionRequest $sessionRequest): void
    {
        $task = $this->task_finder->__invoke(new TaskId($sessionRequest->taskId()));

        $session = Session::create(
            new SessionId(Uuid::generate()->getValue()),
            new SessionStartTime($sessionRequest->startTime()),
            $task,
        );

        $this->session_repository->save($session);
    }
}
