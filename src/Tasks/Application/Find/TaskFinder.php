<?php

namespace App\Tasks\Application\Find;

use App\Tasks\Domain\Exceptions\TaskNotFound;
use App\Tasks\Domain\Task;
use App\Tasks\Domain\TaskRepository;
use App\Tasks\Domain\ValueObject\TaskId;

class TaskFinder
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function __invoke(TaskId $id): Task
    {
        $task = $this->taskRepository->findById($id);

        if(!$task) {
            TaskNotFound::throw($id->getValue());
        }

        return $task;
    }
}
