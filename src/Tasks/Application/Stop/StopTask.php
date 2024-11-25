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
    ) {}

    /**
     * Stops a task by stopping its currently open session.
     */
    public function __invoke(StopTaskRequest $stopTaskRequest): void
    {
        // Find the open session associated with the task ID.
        $openSession = $this->openSessionfinder->__invoke(
            new OpenSessionFinderByTaskIdRequest(
                $stopTaskRequest->id(),
            ),
        );

        // Stop the open session with the provided end time.
        $this->stopSession->__invoke(
            new StopSessionRequest(
                $openSession->id(),
                DateTimeUtils::parseDateTime($stopTaskRequest->endTime()),
            ),
        );
    }
}
