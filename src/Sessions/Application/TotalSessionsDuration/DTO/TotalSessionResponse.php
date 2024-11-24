<?php

namespace App\Sessions\Application\TotalSessionsDuration\DTO;

class TotalSessionResponse
{
    public function __construct(private int $duration)
    {
    }

    public function duration():int
    {
        return $this->duration;
    }
}
