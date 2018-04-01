<?php

namespace Shopee\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Shopee\Client;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;

class MockClient extends Client
{
    /**
     * @var MockHandler
     */
    protected $mock;

    /**
     * @var HandlerStack
     */
    protected $handlerStack;

    /**
     * @todo Collection
     */
    protected $historyContainer = [];

    public function __construct(array $config = [])
    {
        $this->mock = new MockHandler();
        $this->handlerStack = HandlerStack::create($this->mock);
        $this->handlerStack->push(Middleware::history($this->historyContainer));

        $config['httpClient'] = new HttpClient(['handler' => $this->handlerStack]);

        parent::__construct($config);
    }

    public function addResponse(Response $response)
    {
        $this->mock->append($response);
    }

    /**
     * @return array Transaction history
     */
    public function getHistory(): array
    {
        return $this->historyContainer;
    }

    /**
     * @return array Transaction
     */
    public function popHistory(): array
    {
        return array_pop($this->historyContainer);
    }
}
