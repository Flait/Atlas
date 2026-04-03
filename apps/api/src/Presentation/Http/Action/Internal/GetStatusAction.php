<?php

namespace App\Presentation\Http\Action\Internal;

use App\Application\Endpoint\Internal\GetStatusEndpoint;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/internal/status', name: 'api_internal_status', methods: ['GET'])]
final class GetStatusAction
{
    public function __invoke(GetStatusEndpoint $endpoint): JsonResponse
    {
        return new JsonResponse($endpoint->handle());
    }
}
