<?php

namespace Shopee\Tests;

use Shopee\Client;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

trait HelperTrait
{
    public function createMockHttpClient(Response $response): HttpClient
    {
        $mock = new MockHandler([
            $response,
        ]);
        $handler = HandlerStack::create($mock);

        return new HttpClient(['handler' => $handler]);
    }

    public function createClient(array $config = [], Response $response = null): Client
    {
        if ($response !== null) {
            $config['httpClient'] = $this->createMockHttpClient($response);
        }

        $client = new Client(
            array_merge([
                'secret' => '42',
                'partner_id' => 1,
                'shopid' => 10000,
            ], $config)
        );

        return $client;
    }
}
