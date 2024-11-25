<?php

namespace App\Sessions\Application\Find;

use App\Sessions\Domain\Exception\SessionNotFound;
use App\Sessions\Domain\Session;
use App\Sessions\Domain\SessionRepository;
use App\Sessions\Domain\ValueObject\SessionId;

class SessionFinder
{
    public function __construct(private SessionRepository $sessionRepository) {}

    public function __invoke(SessionId $id): Session
    {
        $session = $this->sessionRepository->findById($id);

        if (!$session) {
            SessionNotFound::throw($id->getValue());
        }

        return $session;
    }
}
