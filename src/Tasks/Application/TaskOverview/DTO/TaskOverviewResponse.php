<?php

namespace App\Tasks\Application\TaskOverview\DTO;

class TaskOverviewResponse
{
    // TODO change array to TasksResponse[] to ensure consistency of data
    public function __construct(private array $tasks, private int $totalDuration)
    {
    }

    public function tasks(): array
    {
        return $this->tasks;
    }

    public function duration(): int
    {
        return $this->totalDuration;
    }
}
