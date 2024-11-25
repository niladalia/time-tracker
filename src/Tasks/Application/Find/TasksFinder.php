<?php

namespace App\Tasks\Application\Find;

use App\Tasks\Domain\TaskRepository;
use App\Tasks\Domain\Tasks;

class TasksFinder
{
    public function __construct(private TaskRepository $taskRep) {}

    public function __invoke(): Tasks
    {
        return $this->taskRep->findAll();
    }
}
