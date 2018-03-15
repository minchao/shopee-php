<?php

namespace Shopee\Nodes;

use Psr\Http\Message\UriInterface;
use Shopee\Client;
use Shopee\RequestParameters;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

abstract class NodeAbstract
{
    /** @var Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string|UriInterface $uri
     * @param array|RequestParameters $parameters
     * @return ResponseData
     */
    public function post($uri, $parameters)
    {
        if ($parameters instanceof RequestParametersInterface) {
            $parameters = $parameters->toArray();
        }

        $request = $this->client->newRequest($uri, [], $parameters);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }
}
