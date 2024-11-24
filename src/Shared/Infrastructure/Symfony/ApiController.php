<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony;

use App\Shared\Infrastructure\Symfony\Validation\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints as Assert;

abstract class ApiController extends AbstractController
{
    public function __construct() {}

    protected function validateRequest(mixed $request, Assert\Collection $constraints): void
    {
        Validator::validate($request, $constraints);
    }
}
