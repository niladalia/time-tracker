<?php

namespace App\Tests\Sessions;

use App\Sessions\Domain\Session;
use App\Sessions\Domain\SessionRepository;
use App\Tests\Shared\Infrastructure\IsSimilar;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SessionUnitTestCase extends KernelTestCase
{
    private SessionRepository $sessionRepository;

    protected function setUp(): void
    {
        $this->sessionRepository = $this->createMock(SessionRepository::class);
        $this->mockUuidGeneration();
    }

    public function shouldSave(Session $expectedSession): void
    {
        // Set up the expectation for the save method to be called once with the correct session
        $this->repository()
            ->expects($this->once())
            ->method('save')
            ->with($this->isSimilar($expectedSession, ['endTime', 'totalTime']));
    }

    protected function repository(): SessionRepository
    {
        return $this->sessionRepository;
    }


    protected function isSimilar($expectedObject, array $excludedAttributes): IsSimilar
    {
        return new IsSimilar($expectedObject, $excludedAttributes);
    }

    private function mockUuidGeneration(): void
    {
        $uuid = Uuid::uuid4();

        $factoryMock = \Mockery::mock(UuidFactory::class . '[uuid4]', [
            'uuid4' => $uuid,
        ]);

        Uuid::setFactory($factoryMock);
    }
}
