<?php

namespace Shopee;

use Psr\Http\Message\ResponseInterface;

use function json_decode;

class ResponseData
{
    /** @var ResponseInterface */
    private $response;

    /** @var array */
    private $data;

    public function __construct(ResponseInterface $response)
    {
        $json = $response->getBody()->getContents();
        $data = json_decode($json, true);

        $this->response = $response;
        $this->data = $data;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
