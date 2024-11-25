<?php

namespace App\Tasks\Application\CreateAndStart;

use App\Shared\Domain\Utils\DateTimeUtils;
use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartRequest;
use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartResponse;
use App\Tasks\Application\Resolver\TaskResolver;
use App\Tasks\Application\Start\TaskStarter;
use App\Tasks\Domain\ValueObject\TaskName;
use App\Tasks\Domain\ValueObject\TaskStartTime;

class TaskCreateAndStart
{
    public function __construct(
        private TaskResolver $taskResolver,
        private TaskStarter $taskStarter,
    ) {}

    public function __invoke(TaskCreateAndStartRequest $request): TaskCreateAndStartResponse
    {
        $taskName = new TaskName($request->name());
        $taskStartTime = new TaskStartTime(DateTimeUtils::parseDateTime($request->startTime()));

        // TODO -> Document this
        $task = $this->taskResolver->__invoke(
            $taskName,
        );

        // TODO -> Document this
        $this->taskStarter->__invoke(
            $task,
            $taskStartTime,
        );

        return new TaskCreateAndStartResponse(
            $task->id()->getValue(),
            $task->totalTime()->getValue(),
        );
    }
}
