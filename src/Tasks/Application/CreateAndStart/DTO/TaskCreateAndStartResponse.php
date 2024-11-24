<?php

namespace App\Tasks\Application\CreateAndStart\DTO;


class TaskCreateAndStartResponse
{
    public function __construct(private string $taskId, private float $totalTime)
    {
    }

    public function id(): string
    {
        return $this->taskId;
    }

    public function totalTime(): float
    {
        return $this->totalTime;
    }
}
