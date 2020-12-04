<?php

namespace Shopee;

use Psr\Http\Message\ServerRequestInterface;

class SignatureValidator
{
    protected $signatureGenerator;

    public function __construct(SignatureGeneratorInterface $signatureGenerator)
    {
        $this->signatureGenerator = $signatureGenerator;
    }

    public function isValid(ServerRequestInterface $request): bool
    {
        $url = (string)$request->getUri();
        $body = $request->getBody()->getContents();
        $authorization = $request->getHeaderLine('Authorization');

        if (empty($authorization)) {
            return false;
        }
        if ($this->signatureGenerator->generateSignature($url, $body) !== $authorization) {
            return false;
        }
        return true;
    }
}
