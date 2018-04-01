<?php

namespace Shopee\Tests;

use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use Shopee\Client;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

trait HelperTrait
{
    protected $defaultConfig = [
        'secret' => '42',
        'partner_id' => 1,
        'shopid' => 10000,
    ];

    public function createClient(array $config = [], $httpHandler = null): Client
    {
        if ($httpHandler !== null) {
            $config['httpClient'] = new HttpClient(['handler' => $httpHandler]);
        }

        return new Client(array_merge($this->defaultConfig, $config));
    }

    /**
     * @param array $config
     * @return MockClient
     */
    public function createMockClient(array $config = []): MockClient
    {
        return new MockClient(array_merge($this->defaultConfig, $config));
    }

    public function getRequestParametersFromTransaction(
        array $transaction,
        bool $removeDefaultParameters = false
    ): array {
        /** @var Request $request */
        $request = $transaction['request'];
        $requestParameters = json_decode($request->getBody()->getContents(), true);

        if ($removeDefaultParameters) {
            unset($requestParameters['partner_id']);
            unset($requestParameters['shopid']);
            unset($requestParameters['timestamp']);
        }

        return $requestParameters;
    }
}
