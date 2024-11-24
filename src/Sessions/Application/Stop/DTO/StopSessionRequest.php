<?php

namespace App\Sessions\Application\Stop\DTO;

use DateTime;

class StopSessionRequest
{
    public function __construct(
        private string $sessionId,
        private DateTime $endTime
    )
    {
    }

    public function sessionId(): string
    {
        return $this->sessionId;
    }

    public function endTime(): DateTime
    {
        return $this->endTime;
    }
}
