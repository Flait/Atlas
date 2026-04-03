<?php

namespace App\Tests\Action\Internal;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetStatusActionTest extends WebTestCase
{
    public function testStatusEndpointExposesInternalContract(): void
    {
        $client = static::createClient();
        $client->request('GET', '/internal/status');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');
        self::assertJsonStringEqualsJsonString(
            json_encode([
                'application' => 'atlas-api',
                'scope' => 'internal-admin',
                'status' => 'ok',
            ], JSON_THROW_ON_ERROR),
            (string) $client->getResponse()->getContent(),
        );
    }
}
