<?php

namespace Shopee;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shopee\Exception\InvalidSignatureException;

class VerifySignatureMiddleware implements MiddlewareInterface
{
    protected $signatureGenerator;

    public function __construct(SignatureGeneratorInterface $signatureGenerator)
    {
        $this->signatureGenerator = $signatureGenerator;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws InvalidSignatureException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $url = (string)$request->getUri();
        $body = $request->getBody()->getContents();
        $signature = $this->signatureGenerator->generateSignature($url, $body);

        if ($signature !== $request->getHeaderLine('Authorization')) {
            throw new InvalidSignatureException('Invalid authorization signature');
        }

        return $handler->handle($request);
    }
}
