<?php

namespace App\Tests\Shared\Domain;


use App\Shared\Domain\ValueObject\Uuid;

class UuidMother
{
    public static function create(): string
    {
        return Uuid::generate()->getValue();
    }
}
