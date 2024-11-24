<?php

namespace App\Ui\frontend\Controllers;

use App\Sessions\Application\TotalSessionsDuration\DTO\TotalSessionResponse;
use App\Sessions\Application\TotalSessionsDuration\TotalSessionsDuration;
use App\Shared\Infrastructure\Symfony\WebController;
use App\Tasks\Application\Find\DTO\TasksResponse;
use App\Tasks\Application\Find\TasksFinder;
use Symfony\Component\HttpFoundation\Response;

class TasksWebController extends WebController
{
    public function __invoke(TasksFinder $finder, TotalSessionsDuration $totalDuration): Response
    {
        /** @var TasksResponse $tasksResponse */
        $tasksResponse = $finder->__invoke();

        /** @var TotalSessionResponse $tasksResponse */
        $totalDurationResponse = $totalDuration->__invoke();
        return $this->render(
            'task_home.html.twig',
            [
                'tasks' => $tasksResponse->tasks(),
                'totalDuration' => $totalDurationResponse->duration()
            ]
        );

    }
}
