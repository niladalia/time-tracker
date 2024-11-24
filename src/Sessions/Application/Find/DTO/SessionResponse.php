<?php

namespace App\Sessions\Application\Find\DTO;

class SessionResponse
{
    public function __construct(private string $id)
    {
    }

    public function id():string
    {
        return $this->id;
    }
}
