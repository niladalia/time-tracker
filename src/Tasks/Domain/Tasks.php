<?php

namespace App\Tasks\Domain;

final class Tasks
{
    /**
     * @var Task[]
     */
    public $tasks;

    public function __construct(Task ...$tasks)
    {
        $this->tasks = $tasks;
    }

    public function getTasks(): array
    {
        return $this->tasks;  // Return the array of Task objects
    }

    public function toArray(): array
    {
        return array_map(fn($task) => $task->toArray(), $this->tasks);
    }
}
