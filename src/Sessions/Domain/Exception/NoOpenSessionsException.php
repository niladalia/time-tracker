<?php

namespace App\Sessions\Domain\Exception;

use DomainException;

class NoOpenSessionsException extends DomainException
{
    public static function throw(?string $id = '')
    {
        throw new self("Task {$id} have no open sessions !");
    }
    public function getStatusCode()
    {
        return 400;
    }
}
