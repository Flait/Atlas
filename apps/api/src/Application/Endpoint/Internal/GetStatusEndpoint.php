<?php

namespace App\Application\Endpoint\Internal;

final class GetStatusEndpoint
{
    public function handle(): array
    {
        return [
            'application' => 'atlas-api',
            'scope' => 'internal-admin',
            'status' => 'ok',
        ];
    }
}
