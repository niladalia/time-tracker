<?php

class TaskStopService
{
    private $taskRepository;
    private $sessionRepository;

    public function __construct(TaskRepository $taskRepository, SessionRepository $sessionRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->sessionRepository = $sessionRepository;
    }

    public function stopTask(TaskId $taskId)
    {
        $task = $this->taskRepository->find($taskId);

        // Retrieve the active session for the task
        $activeSession = $task->getActiveSession();

        // Stop the session
        $sessionService = new StopSessionService($this->sessionRepository);
        $sessionService->stopSession($activeSession);

        // Update the task to reflect the total time spent
        $task->updateTimeSpent($activeSession->getTotalTime());

        // Persist changes
        $this->taskRepository->save($task);
    }
}

// StopSessionService.php
class StopSessionService
{
    private $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    public function stopSession(Session $session)
    {
        // Stop the session logic, update its end time, etc.
        $session->stop();

        // Save the updated session
        $this->sessionRepository->save($session);
    }
}
