<?php

namespace Shopee\Nodes;

use Psr\Http\Message\UriInterface;
use Shopee\Client;
use Shopee\RequestParams;
use Shopee\RequestParamsInterface;
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
     * @param array|RequestParams $params
     * @return ResponseData
     */
    public function post($uri, $params)
    {
        if ($params instanceof RequestParamsInterface) {
            $params = $params->toArray();
        }

        $request = $this->client->newRequest($uri, [], $params);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }
}
