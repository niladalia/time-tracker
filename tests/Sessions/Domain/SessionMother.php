<?php

namespace App\Tests\Sessions\Domain;

use App\Sessions\Domain\Session;
use App\Sessions\Domain\ValueObject\SessionEndTime;
use App\Sessions\Domain\ValueObject\SessionId;
use App\Sessions\Domain\ValueObject\SessionStartTime;
use App\Tasks\Domain\Task;
use App\Tests\Sessions\Domain\ValueObject\SessionEndTimeMother;
use App\Tests\Sessions\Domain\ValueObject\SessionIdMother;
use App\Tests\Sessions\Domain\ValueObject\SessionStartTimeMother;
use App\Tests\Tasks\Domain\TaskMother;

class SessionMother
{
    public static function create(
        ?Task $task = null,
        ?SessionId $id = null,
        ?SessionStartTime $startTime = null,
        ?SessionEndTime $endTime = null
    ): Session
    {
        $session = new Session(
            $id ?? SessionIdMother::create(),
            $startTime ?? SessionStartTimeMother::now(),
            $task ?? TaskMother::create()
        );

        if ($endTime) {
            $session->stop($endTime);
        }else{
            $session->setEndTime(SessionEndTimeMother::create(null));
        }

        $task->sessions[] = $session;

        return $session;
    }

}
