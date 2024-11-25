<?php

namespace App\Tasks\Application\TaskOverview;

use App\Sessions\Application\TotalSessionsDuration\DTO\TotalSessionResponse;
use App\Sessions\Application\TotalSessionsDuration\TotalSessionsDuration;
use App\Tasks\Application\Find\TasksFinder;
use App\Tasks\Application\TaskOverview\DTO\TaskOverviewResponse;

class TasksOverview
{
    public function __construct(private TasksFinder $tasksFinder, private TotalSessionsDuration $totalSessionsDuration) {}

    public function __invoke(): TaskOverviewResponse
    {
        $allTasks = $this->tasksFinder->__invoke();

        /** @var TotalSessionResponse $durationResponse */
        $durationResponse = $this->totalSessionsDuration->__invoke();

        return new TaskOverviewResponse(
            $allTasks->toArray(),
            $durationResponse->duration(),
        );
    }

}
