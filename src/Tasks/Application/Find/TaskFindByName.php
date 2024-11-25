<?php

namespace App\Tasks\Application\Find;

use App\Tasks\Domain\Task;
use App\Tasks\Domain\TaskRepository;
use App\Tasks\Domain\ValueObject\TaskName;

class TaskFindByName
{
    public function __construct(private TaskRepository $taskRepository) {}

    public function __invoke(TaskName $taskName): ?Task
    {
        $task = $this->taskRepository->findByName($taskName);

        return $task;
    }
}
