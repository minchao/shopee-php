<?php

namespace Shopee\Tests;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\UriInterface;
use Shopee\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    use HelperTrait;

    /**
     * @throws \Exception
     */
    public function testCreateClient(): void
    {
        $client = $this->createClient();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
        $this->assertInstanceOf(UriInterface::class, $client->getBaseUrl());
        $this->assertEquals(Client::DEFAULT_BASE_URL, $client->getBaseUrl()->__toString());
        $this->assertEquals(Client::DEFAULT_USER_AGENT, $client->getUserAgent());
    }
}
