<?php

namespace App\Controller\Internal;

use App\Application\Internal\GetStatusHandler;
use Symfony\Component\HttpFoundation\JsonResponse;

final class StatusController
{
    public function __invoke(GetStatusHandler $handler): JsonResponse
    {
        return new JsonResponse($handler->handle());
    }
}
