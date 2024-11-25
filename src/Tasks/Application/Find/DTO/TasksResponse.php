<?php

namespace App\Tasks\Application\Find\DTO;

class TasksResponse
{
    /**
     * @var TaskResponse[]
     */
    private readonly array $tasks;

    public function __construct(TaskResponse ...$tasks)
    {
        $this->tasks = $tasks;
    }


    public function tasks(): array
    {
        return array_map(fn($task) => $task->data(), $this->tasks);
    }


}
