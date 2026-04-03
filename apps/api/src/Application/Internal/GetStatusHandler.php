<?php

namespace App\Application\Internal;

final class GetStatusHandler
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
