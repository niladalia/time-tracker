<?php

namespace App\Ui\frontend\Controllers;

use App\Sessions\Application\TotalSessionsDuration\DTO\TotalSessionResponse;
use App\Sessions\Application\TotalSessionsDuration\TotalSessionsDuration;
use App\Shared\Infrastructure\Symfony\WebController;
use App\Tasks\Application\Find\DTO\TasksResponse;
use App\Tasks\Application\Find\TasksFinder;
use App\Tasks\Application\TaskOverview\DTO\TaskOverviewResponse;
use App\Tasks\Application\TaskOverview\TasksOverview;
use Symfony\Component\HttpFoundation\Response;

class TasksWebController extends WebController
{
    public function __invoke(TasksOverview $taskOverview): Response
    {
        /** @var TaskOverviewResponse $tasksOverviewResponse */
        $tasksOverviewResponse = $taskOverview->__invoke();
        return $this->render(
            'task_home.html.twig',
            [
                'tasks' => $tasksOverviewResponse->tasks(),
                'totalDuration' => $tasksOverviewResponse->duration()
            ]
        );

    }
}
