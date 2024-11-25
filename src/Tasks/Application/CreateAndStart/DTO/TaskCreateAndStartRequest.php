<?php

namespace App\Tasks\Application\CreateAndStart\DTO;

class TaskCreateAndStartRequest
{
    public function __construct(
        private string $name,
        private string $startTime,
    ) {}

    public function name(): string
    {
        return $this->name;
    }

    public function startTime(): string
    {
        return $this->startTime;
    }
}
