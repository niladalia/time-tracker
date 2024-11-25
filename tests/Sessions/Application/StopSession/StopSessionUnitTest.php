<?php

namespace App\Tests\Sessions\Application\StopSession;

use App\Sessions\Application\Find\SessionFinder;
use App\Sessions\Application\Stop\DTO\StopSessionRequest;
use App\Sessions\Application\Stop\StopSession;
use App\Tests\Sessions\Domain\SessionMother;
use App\Tests\Sessions\Domain\ValueObject\SessionEndTimeMother;
use App\Tests\Sessions\Domain\ValueObject\SessionIdMother;
use App\Tests\Sessions\Domain\ValueObject\SessionStartTimeMother;
use App\Tests\Sessions\SessionUnitTestCase;
use App\Tests\Tasks\Domain\TaskMother;

class StopSessionUnitTest extends SessionUnitTestCase
{
    private StopSession $stopSession;
    private $sessionFinder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sessionFinder = $this->createMock(SessionFinder::class);
        $this->stopSession = new StopSession(
            $this->repository(),
            $this->sessionFinder,
        );
    }

    public function testItStopsTheSession(): void
    {
        $sessionId = SessionIdMother::create();
        $startTime = SessionStartTimeMother::now();
        $endTime = SessionEndTimeMother::create($startTime->getValue()->modify('+10 seconds'));
        $task = TaskMother::create();

        $session = SessionMother::create($task, $sessionId, $startTime, $endTime);

        $totalDuration = $endTime->formatMilliseconds() - $startTime->formatMilliseconds();
        $expectedTotalTime = $totalDuration;

        $this->sessionFinder
            ->expects($this->once())
            ->method('__invoke')
            ->with($this->equalTo($sessionId))
            ->willReturn($session);

        $this->shouldSave($session);

        $endSessionRequest = new StopSessionRequest($sessionId, $endTime->getValue());

        $this->stopSession->__invoke($endSessionRequest);

        $this->assertEquals($endTime, $session->endTime());

        $this->assertEquals($expectedTotalTime, $session->totalTime()->getValue());
    }
}
