<?php

namespace App\Tasks\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Infrastructure\Symfony\Repository\DoctrineDatabaseRepository;
use App\Tasks\Domain\Task;
use App\Tasks\Domain\TaskRepository;
use App\Tasks\Domain\Tasks;
use App\Tasks\Domain\ValueObject\TaskId;
use App\Tasks\Domain\ValueObject\TaskName;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineTaskRepository extends DoctrineDatabaseRepository implements TaskRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findAll(): ?Tasks
    {
        $allTasks = $this->findBy([]);

        return new Tasks(...$allTasks);
    }

    public function findById(TaskId $id): ?Task
    {
        return $this->find($id->getValue());
    }

    public function findByName(TaskName $taskName): ?Task
    {
        return $this->findOneBy([
            'name.value' => $taskName->getValue(),
        ]);
    }
}
