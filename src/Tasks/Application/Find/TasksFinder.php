<?php

namespace App\Tasks\Application\Find;



use App\Tasks\Application\Find\DTO\TaskResponse;
use App\Tasks\Application\Find\DTO\TasksResponse;
use App\Tasks\Domain\TaskRepository;
use App\Tasks\Domain\Tasks;

class TasksFinder
{
    public function __construct(private TaskRepository $taskRep) {}


    public function __invoke(): TasksResponse
    {
        $allTasks = $this->taskRep->findAll();

        $taskResponses = $this->mapTasksToResponse($allTasks);

        return new TasksResponse(...$taskResponses);
    }

    private function mapTasksToResponse(Tasks $tasks): array
    {
        return array_map(function($task) {
            return new TaskResponse(
                $task->id()->getValue(),
                $task->name()->getValue(),
                $task->totalTime()->toInt()
            );
        }, $tasks->getTasks());
    }



}
