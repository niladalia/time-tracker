<?php

namespace App\Tasks\Application\Resolver;

use App\Tasks\Application\Create\TaskCreator;
use App\Tasks\Application\Find\TaskFindByName;
use App\Tasks\Domain\Task;
use App\Tasks\Domain\ValueObject\TaskName;

class TaskResolver
{
    public function __construct(
        private TaskFindByName $taskFindByName,
        private TaskCreator $taskCreator,
    ) {}


    public function __invoke(TaskName $taskName): Task
    {
        $task = $this->taskFindByName->__invoke($taskName);

        if (!$task) {
            $task = $this->taskCreator->__invoke(
                $taskName,
            );
        }

        return $task;
    }
}
