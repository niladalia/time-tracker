<?php

namespace App\Tasks\Application\TaskOverview;

use App\Sessions\Application\TotalSessionsDuration\DTO\TotalSessionResponse;
use App\Sessions\Application\TotalSessionsDuration\TotalSessionsDuration;
use App\Tasks\Application\Find\TasksFinder;
use App\Tasks\Application\TaskOverview\DTO\TaskOverviewResponse;


/**
 * This class provides the required info for the Tasks homepage :
 *    - A list of all tasks
 *    - Total duration of the tasks
 */

class TasksOverview
{
    public function __construct(private TasksFinder $tasksFinder, private TotalSessionsDuration $totalSessionsDuration) {}

    public function __invoke(): TaskOverviewResponse
    {
        $allTasks = $this->tasksFinder->__invoke();

        // Instead of calculating the total duration by summing up the times from $allTasks directly,
        // I created a dedicated service to extract it. This approach enhances reusability and separation of concerns.
        /** @var TotalSessionResponse $durationResponse */
        $durationResponse = $this->totalSessionsDuration->__invoke();

        return new TaskOverviewResponse(
            $allTasks->toArray(),
            $durationResponse->duration(),
        );
    }

}
