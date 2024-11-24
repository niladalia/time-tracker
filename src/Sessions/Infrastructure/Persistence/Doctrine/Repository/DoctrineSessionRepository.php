<?php

namespace App\Sessions\Infrastructure\Persistence\Doctrine\Repository;

use App\Sessions\Domain\Session;
use App\Sessions\Domain\SessionRepository;
use App\Sessions\Domain\ValueObject\SessionId;
use App\Sessions\Domain\ValueObject\SessionTaskId;
use App\Shared\Infrastructure\Symfony\Repository\DoctrineDatabaseRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineSessionRepository extends DoctrineDatabaseRepository implements SessionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function findById(SessionId $id): ?Session
    {
        return $this->find($id->getValue());
    }

    public function findOpenSessionByTaskId(SessionTaskId $id): ?Session
    {
        return $this->findOneBy([
            'task' => $id->getValue(),
            'endTime.value' => null
        ]);
    }

    public function sumTotalDurations(): ?int
    {
        $conn = $this->_em->getConnection();
        $sql = 'SELECT SUM(FLOOR(total_time)) FROM sessions'; // raw SQL query
        $result = $conn->fetchOne($sql);

        return (int) $result;
    }
}
