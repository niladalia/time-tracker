<?php

namespace App\Tasks\Domain\ValueObject;

use App\Shared\Domain\Exceptions\InvalidArgument;
use App\Shared\Domain\ValueObject\StringValueObject;

final class TaskName extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->validate();
    }

    private function validate()
    {
        if ($this->value == null || strlen($this->value) <= 2) {
            InvalidArgument::throw('El Nombre tiene que tener un mínimo de 3 caracteres');
        }
    }
}
