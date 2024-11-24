<?php

namespace App\Tasks\Application\Stop;

use App\Sessions\Application\Find\DTO\OpenSessionFinderByTaskIdRequest;
use App\Sessions\Application\Find\OpenSessionFinderByTaskId;
use App\Sessions\Application\Stop\DTO\StopSessionRequest;
use App\Sessions\Application\Stop\StopSession;
use App\Shared\Domain\Utils\DateTimeUtils;
use App\Tasks\Application\Stop\DTO\StopTaskRequest;

class StopTask
{
    public function __construct(
        private StopSession $stopSession,
        private OpenSessionFinderByTaskId $openSessionfinder,
    )
    {
    }

    public function __invoke(StopTaskRequest $stopTaskRequest): void
    {
        // No tindriem que comprobar que existeix el task? Indirectament no tindriem que cridar al Finder?

        // TODO valorar ficar en un servei StopSessionByTaskId o ACL (major structure change, nomes si vui desacoplar completament)
        // TODO ALERTA ACOPLAMENT (ACL getOpenSessionsForTaskId) (reutilitzat per TaskStarter)
        $openSession = $this->openSessionfinder->__invoke(
            new OpenSessionFinderByTaskIdRequest(
                $stopTaskRequest->id()
            )
        );
        // TODO ALERTA ACOPLAMENT (Event de Domini o ACL (interface SessionsAdapterACL stopSession() ))
        $this->stopSession->__invoke(
            new StopSessionRequest(
                $openSession->id(),
                DateTimeUtils::parseDateTime($stopTaskRequest->endTime())
            )
        );

    }
}
