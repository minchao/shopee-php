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
    public function createClient(array $config = [], $httpHandler = null): Client
    {
        if ($httpHandler !== null) {
            $config['httpClient'] = new HttpClient(['handler' => $httpHandler]);
        }

        return new Client(
            array_merge([
                'secret' => '42',
                'partner_id' => 1,
                'shopid' => 10000,
            ], $config)
        );
    }

    /**
     * @param Response[] $responses
     * @param array|null $historyContainer
     * @param array $config
     * @return Client
     */
    public function createMockClient(array $responses, array &$historyContainer = null, array $config = []): Client
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);

        if ($historyContainer !== null) {
            $history = Middleware::history($historyContainer);
            $handler->push($history);
        }

        $config['httpClient'] = new HttpClient(['handler' => $handler]);

        return $this->createClient($config);
    }

    public function getRequestParametersFromHistory(
        array $historyContainer,
        bool $removeDefaultParameters = false
    ): array {
        $parameters = [];

        foreach ($historyContainer as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $requestParameters = json_decode($request->getBody()->getContents(), true);

            if ($removeDefaultParameters) {
                unset($requestParameters['partner_id']);
                unset($requestParameters['shopid']);
                unset($requestParameters['timestamp']);
            }

            $parameters[] = $requestParameters;
        }

        return $parameters;
    }
}
