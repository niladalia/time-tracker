<?php

namespace App\Sessions\Domain;

use App\Sessions\Domain\ValueObject\SessionId;
use App\Sessions\Domain\ValueObject\SessionTaskId;
use App\Shared\Domain\Repository\DatabaseRepository;

/**
 * @implements DatabaseRepository<Session>
 */
interface SessionRepository extends DatabaseRepository
{
    public function findById(SessionId $id): ?Session;

    public function findOpenSessionByTaskId(SessionTaskId $id): ?Session;

    public function sumTotalDurations(): ?int;

}
