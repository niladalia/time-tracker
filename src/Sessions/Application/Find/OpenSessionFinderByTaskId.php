<?php

namespace App\Sessions\Application\Find;

use App\Sessions\Application\Find\DTO\OpenSessionFinderByTaskIdRequest;
use App\Sessions\Application\Find\DTO\SessionResponse;
use App\Sessions\Domain\Exception\NoOpenSessionsException;
use App\Sessions\Domain\SessionRepository;
use App\Sessions\Domain\ValueObject\SessionTaskId;

class OpenSessionFinderByTaskId
{
    public function __construct(private SessionRepository $sessionRepository) {}

    public function __invoke(OpenSessionFinderByTaskIdRequest $request): SessionResponse
    {
        $taskId = $request->taskId();

        $session = $this->sessionRepository->findOpenSessionByTaskId(
            new SessionTaskId($taskId),
        );

        if (!$session) {
            NoOpenSessionsException::throw($taskId);
        }

        return new SessionResponse($session->id()->getValue());
    }
}
