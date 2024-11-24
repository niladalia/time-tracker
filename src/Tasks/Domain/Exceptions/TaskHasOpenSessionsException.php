<?php

namespace App\Tasks\Domain\Exceptions;

use DomainException;

class TaskHasOpenSessionsException extends DomainException
{
    public static function throw(?string $id = '')
    {
        throw new self("Task {$id} is already running ! Stop it before creating a new one !");
    }
    public function getStatusCode()
    {
        return 400;
    }
}
