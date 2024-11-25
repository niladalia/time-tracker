<?php

namespace App\Tasks\Application\Find\DTO;

class TaskResponse
{
    public function __construct(private string $id, private string $name, private float $totalTime) {}

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function totalTime(): float
    {
        return $this->totalTime;
    }

    public function data(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'total_time' => $this->totalTime,
        ];
    }
}
