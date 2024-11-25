<?php

namespace App\Sessions\Domain;

use App\Sessions\Domain\ValueObject\SessionEndTime;
use App\Sessions\Domain\ValueObject\SessionId;
use App\Sessions\Domain\ValueObject\SessionStartTime;
use App\Sessions\Domain\ValueObject\SessionTotalTime;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\Utils\DateTimeUtils;
use App\Tasks\Domain\Task;

class Session extends AggregateRoot
{
    private SessionEndTime $endTime;
    private SessionTotalTime $totalTime;

    public function __construct(
        private SessionId $id,
        private SessionStartTime $startTime,
        private Task $task
    )
    {
    }

    static function create(
        SessionId $id,
        SessionStartTime $startTime,
        Task $task
    ): self{
        return new self($id, $startTime, $task);
    }

    public function task(): Task
    {
        return $this->task;
    }

    public function stop(SessionEndTime $endTime): void
    {
        $totalDuration = ($endTime->formatMilliseconds() - $this->startTime->formatMilliseconds());

        $this->setEndTime($endTime);

        $this->setTotalTime(new SessionTotalTime($totalDuration));
    }

    public function id(): SessionId
    {
        return $this->id;
    }

    public function endTime(): SessionEndTime
    {
        return $this->endTime;
    }

    public function startTime(): SessionStartTime
    {
        return $this->startTime;
    }

    public function totalTime(): SessionTotalTime
    {
        return $this->totalTime;
    }

    public function setEndTime(SessionEndTime $endTime): void{
        $this->endTime = $endTime;
    }

    public function setTotalTime(SessionTotalTime $totalTime): void{
        $this->totalTime = $totalTime;
    }

    public function getCurrentDuration(): float
    {
        if ($this->isRunning()) {
            $startTime = $this->startTime(); // Expose start time as DateTime
            $now = DateTimeUtils::now();
            return $now->format('U.u') - $startTime->formatMilliseconds();
        }
        return $this->totalTime()->getValue();
    }

    public function isRunning(): bool
    {
        return $this->endTime()->getValue() === null;
    }
}
