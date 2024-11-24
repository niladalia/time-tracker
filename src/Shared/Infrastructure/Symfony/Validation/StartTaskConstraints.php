<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class StartTaskConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'name' => self::required(self::type('string')),
            'start_time' => self::required($this->dateTimeConstraints())
        ];
    }
}
