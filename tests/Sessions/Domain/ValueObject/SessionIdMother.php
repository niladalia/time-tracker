<?php

namespace App\Tests\Sessions\Domain\ValueObject;

use App\Sessions\Domain\ValueObject\SessionId;
use App\Shared\Domain\ValueObject\Uuid;

class SessionIdMother
{
    public static function create(?string $value = null): SessionId
    {
        return new SessionId($value ? Uuid::fromString($value) : Uuid::generate());
    }
}
