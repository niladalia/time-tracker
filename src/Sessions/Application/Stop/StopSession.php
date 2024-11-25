<?php

namespace App\Sessions\Application\Stop;

use App\Sessions\Application\Find\SessionFinder;
use App\Sessions\Application\Stop\DTO\StopSessionRequest;
use App\Sessions\Domain\SessionRepository;
use App\Sessions\Domain\ValueObject\SessionEndTime;
use App\Sessions\Domain\ValueObject\SessionId;

class StopSession
{
    public function __construct(
        private SessionRepository $sessionRepository,
        private SessionFinder $sessionFinder,
    ) {}

    public function __invoke(StopSessionRequest $endSessionRequest): void
    {
        $session = $this->sessionFinder->__invoke(new SessionId($endSessionRequest->sessionId()));

        $session->stop(new SessionEndTime($endSessionRequest->endTime()));

        $this->sessionRepository->save($session);
    }
}
