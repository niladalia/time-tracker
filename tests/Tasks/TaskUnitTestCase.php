<?php

namespace App\Tests\Tasks;

use App\Tasks\Domain\Task;
use App\Tasks\Domain\TaskRepository;
use App\Tests\Shared\Infrastructure\IsSimilar;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskUnitTestCase extends KernelTestCase
{
    private TaskRepository $taskRepository;

    protected function setUp(): void
    {
        $this->taskRepository = $this->createMock(TaskRepository::class);
        $this->mockUuidGeneration();
    }

    public function shouldSave(Task $expectedTask): void
    {
        // Set up the expectation for the save method to be called once with the correct task
        $this->repository()
            ->expects($this->once())
            ->method('save')
            ->with($this->isSimilar($expectedTask, []));
    }

    protected function repository(): TaskRepository
    {
        return $this->taskRepository;
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
