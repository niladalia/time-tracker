<?php

namespace App\Sessions\Domain\Exception;

use DomainException;

class SessionNotFound extends DomainException
{
    public static function throw(?string $id = '')
    {
        throw new self("Session {$id} not found");
    }
    public function getStatusCode()
    {
        return 400;
    }
}
