<?php

namespace App\Tests\Application\Endpoint\Internal;

use App\Application\Endpoint\Internal\GetStatusEndpoint;
use PHPUnit\Framework\TestCase;

final class GetStatusEndpointTest extends TestCase
{
    public function testItReturnsInternalApiStatusPayload(): void
    {
        $payload = (new GetStatusEndpoint())->handle();

        self::assertSame('atlas-api', $payload['application']);
        self::assertSame('internal-admin', $payload['scope']);
        self::assertSame('ok', $payload['status']);
    }
}
