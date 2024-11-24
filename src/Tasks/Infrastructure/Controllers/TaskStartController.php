<?php

namespace App\Tasks\Infrastructure\Controllers;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\StartTaskConstraints;
use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartRequest;
use App\Tasks\Application\CreateAndStart\DTO\TaskCreateAndStartResponse;
use App\Tasks\Application\CreateAndStart\TaskCreateAndStart;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TaskStartController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(Request $request, TaskCreateAndStart $taskCreateAndStart): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $this->validateRequest($requestData, $this->constraints());

        /** @var TaskCreateAndStartResponse $startTaskResponse */
        $startTaskResponse = $taskCreateAndStart->__invoke(
            new TaskCreateAndStartRequest(
                $requestData['name'],
                $requestData['start_time'],
            )
        );
        return $this->json(
            [
                'task_id' => $startTaskResponse->id(),
                'total_time' => $startTaskResponse->totalTime()
            ],
            Response::HTTP_OK);
    }

    protected function constraints(): Assert\Collection
    {
        return StartTaskConstraints::constraints();
    }
}
