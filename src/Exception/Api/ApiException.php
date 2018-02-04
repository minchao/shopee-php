<?php

namespace Shopee\Exception\Api;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiException extends \RuntimeException
{
    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface|null */
    private $response;

    /** @var array */
    private $context;

    public function __construct(
        string $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null,
        array $context = []
    ) {
        parent::__construct($message, $response->getStatusCode(), $previous);
        $this->request = $request;
        $this->response = $response;
        $this->context = $context;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
