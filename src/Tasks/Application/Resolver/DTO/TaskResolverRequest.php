<?php

namespace App\Tasks\Application\Resolver\DTO;

use DateTime;
class TaskResolverRequest
{
    public function __construct(
        private string $id,
        private string $name
    ) {}


    public function id(): ?string
    {
        return $this->id;
    }
    public function name(): ?string
    {
        return $this->name;
    }
}
