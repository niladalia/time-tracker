<?php

namespace App\Tasks\Application\Create;

use App\Shared\Domain\ValueObject\Uuid;
use App\Tasks\Domain\Task;
use App\Tasks\Domain\TaskRepository;
use App\Tasks\Domain\ValueObject\TaskId;
use App\Tasks\Domain\ValueObject\TaskName;

class TaskCreator
{
    public function __construct(
        private TaskRepository $task_repository,
    ) {}

    public function __invoke(TaskName $name): Task
    {
        $uuid = Uuid::generate();
        $task = Task::create(
            new TaskId($uuid),
            $name,
        );

        $this->task_repository->save($task);

        return $task;
    }
}
