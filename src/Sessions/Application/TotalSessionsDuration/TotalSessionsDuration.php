<?php

namespace App\Sessions\Application\TotalSessionsDuration;

use App\Sessions\Application\TotalSessionsDuration\DTO\TotalSessionResponse;
use App\Sessions\Domain\SessionRepository;

class TotalSessionsDuration
{
    public function __construct(private SessionRepository $sessionRepository) {}

    public function __invoke(): TotalSessionResponse
    {
        $totalDuration = $this->sessionRepository->sumTotalDurations();

        return new TotalSessionResponse(
            $totalDuration,
        );
    }
}
