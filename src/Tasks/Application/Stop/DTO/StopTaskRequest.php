<?php

    namespace App\Tasks\Application\Stop\DTO;

class StopTaskRequest
{
    public function __construct(
        private string $id,
        private string $endTime
    ) {}

    public function id(): ?string
    {
        return $this->id;
    }

    public function endTime(): string
    {
        return $this->endTime;
    }

}
