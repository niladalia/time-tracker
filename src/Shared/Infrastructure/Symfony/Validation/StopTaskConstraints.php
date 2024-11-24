<?php

namespace App\Shared\Infrastructure\Symfony\Validation;

class StopTaskConstraints extends ValidationConstraints
{
    protected function fields(): array
    {
        return [
            'end_time' => self::required($this->dateTimeConstraints())
        ];
    }
}
