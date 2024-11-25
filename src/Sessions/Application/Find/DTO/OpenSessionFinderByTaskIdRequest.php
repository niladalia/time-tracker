<?php

namespace App\Sessions\Application\Find\DTO;

class OpenSessionFinderByTaskIdRequest
{
    public function __construct(
        private string $taskId,
    ) {}

    public function taskId(): string
    {
        return $this->taskId;
    }
}
