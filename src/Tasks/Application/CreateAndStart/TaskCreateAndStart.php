<?php

namespace App\Tasks\Application\CreateAndStart;

use App\Shared\Domain\Utils\DateTimeUtils;
use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartRequest;
use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartResponse;
use App\Tasks\Application\Resolver\TaskResolver;
use App\Tasks\Application\Start\TaskStarter;
use App\Tasks\Domain\ValueObject\TaskName;
use App\Tasks\Domain\ValueObject\TaskStartTime;

/**
 * Handles the creation and starting of a task in a single operation.
 *
 * This service encapsules the business logic that:
 * 1. If a task with the given name already exists, it retrieves it; otherwise, it creates a new task.
 * 2. It starts the task creating a new session associated with the resolved task.
 *
 */

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

        // Resolves the task by retrieving it if it exists or creating a new one if it doesn't.
        $task = $this->taskResolver->__invoke($taskName);


        // Starts the Task
        $this->taskStarter->__invoke($task, $taskStartTime);

        return new TaskCreateAndStartResponse(
            $task->id()->getValue(),
            $task->totalTime()->getValue(),
        );
    }
}
