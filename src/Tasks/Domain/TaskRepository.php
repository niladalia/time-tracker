<?php

namespace App\Tasks\Domain;

use App\Shared\Domain\Repository\DatabaseRepository;
use App\Tasks\Domain\ValueObject\TaskId;
use App\Tasks\Domain\ValueObject\TaskName;

interface TaskRepository extends DatabaseRepository
{
    public function findAll(): ?Tasks;

    public function findById(TaskId $id): ?Task;

    public function findByName(TaskName $id): ?Task;

}
