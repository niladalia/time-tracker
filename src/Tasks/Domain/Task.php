<?php

namespace App\Tasks\Domain;

use App\Shared\Domain\AggregateRoot;
use App\Tasks\Domain\ValueObject\TaskId;
use App\Tasks\Domain\ValueObject\TaskName;
use App\Tasks\Domain\ValueObject\TaskTotalTime;

class Task extends AggregateRoot
{
    public $sessions = [];

    public function __construct(
        private TaskId $id,
        private TaskName $name,
    ) {}

    public static function create(
        TaskId $id,
        TaskName $name,
    ): self {
        return new self($id, $name);
    }

    public function id(): TaskId
    {
        return $this->id;
    }

    public function name(): TaskName
    {
        return $this->name;
    }

    public function sessions(): array
    {
        return $this->sessions;
    }

    public function totalTime(): TaskTotalTime
    {
        $sessions = $this->sessions;
        $totalTime = 0;

        foreach ($sessions as $session) {
            $totalTime =  $totalTime + $session->getCurrentDuration();
        }

        return new TaskTotalTime($totalTime);
    }

    public function hasOpenSession(): bool
    {
        $sessions = $this->sessions;
        foreach ($sessions as $session) {
            if ($session->isRunning()) {
                return true;
            }
        }
        return false;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->getValue(),
            'name' => $this->name()->getValue(),
            'total_time' => $this->totalTime()->toInt(),
        ];
    }

}
