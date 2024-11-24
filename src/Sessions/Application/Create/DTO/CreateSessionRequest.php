<?php

namespace App\Sessions\Application\Create\DTO;

use DateTime;
class CreateSessionRequest
{
    public function __construct(
        private string $taskId,
        private DateTime $startTime
    )
    {
    }

    public function taskId(): string
    {
        return $this->taskId;
    }

    public function startTime(): DateTime
    {
        return $this->startTime;
    }
}
