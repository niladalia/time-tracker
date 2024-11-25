<?php

namespace App\Tasks\Application\Resolver\DTO;

class TaskResolverResponse
{
    public function __construct(private string $taskId) {}

    public function taskId(): string
    {
        return $this->taskId;
    }
}
