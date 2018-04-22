<?php

namespace Shopee\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Shopee\Client;
use GuzzleHttp\Client as HttpClient;

use function is_array;
use function array_merge;

trait ClientTrait
{
    protected $defaultConfig = [
        'secret' => '42',
        'partner_id' => 1,
        'shopid' => 10000,
    ];

    /**
     * @param Response|Response[] $responses
     * @param array|\ArrayAccess $history
     * @return HandlerStack
     */
    public function createMockHandler($responses, &$history = []): HandlerStack
    {
        if (!is_array($responses)) {
            $responses = [$responses];
        }

        $handler = HandlerStack::create(new MockHandler($responses));
        $handler->push(Middleware::history($history));

        return $handler;
    }

    /**
     * @param Response|Response[] $responses
     * @param array|\ArrayAccess $history
     * @return HttpClient
     */
    public function createHttpClient($responses, &$history = []): HttpClient
    {
        $httpHandler = $this->createMockHandler($responses, $history);

        return new HttpClient(['handler' => $httpHandler]);
    }

    public function createClient(array $config = [], HttpClient $httpClient = null): Client
    {
        if ($httpClient !== null) {
            $config['httpClient'] = $httpClient;
        }

        return new Client(array_merge($this->defaultConfig, $config));
    }
}
