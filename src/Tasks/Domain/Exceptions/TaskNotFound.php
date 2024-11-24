<?php

namespace App\Tasks\Domain\Exceptions;

use DomainException;

class TaskNotFound extends DomainException
{
    public static function throw(?string $id = '')
    {
        throw new self("Task {$id} not found");
    }
    public function getStatusCode()
    {
        return 400;
    }
}
