<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/modern', name: 'app_modern')]
class ModernController
{
    public function __invoke(): Response
    {
        return new Response('Hello Modern World!');
    }
}
