<?php

namespace App\Sessions\Infrastructure\Controllers;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Sessions\TaskSessions\Application\Resolver\SessionResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SessionStartController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(Request $request, SessionResolver $resolver): Response
    {
        // Cridem al SessionResolver que ens retornará un $id

        // Cridem al SessionStarter
        // Busca la Session segons el $id
        //

        return $this->json(['success' => "success"], Response::HTTP_OK);
    }
}
