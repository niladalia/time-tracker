<?php

namespace App\Tasks\Infrastructure\Controllers;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Validation\StopTaskConstraints;
use App\Tasks\Application\Stop\DTO\StopTaskRequest;
use App\Tasks\Application\Stop\StopTask;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TaskStopController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(Request $request, StopTask $stopTaskService, string $id): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $this->validateRequest($requestData, $this->constraints());

        $stopTaskService->__invoke(
            new StopTaskRequest(
                $id,
                $requestData['end_time'],
            ),
        );
        return $this->json(
            [ ],
            Response::HTTP_OK,
        );
    }

    protected function constraints(): Assert\Collection
    {
        return StopTaskConstraints::constraints();
    }
}
