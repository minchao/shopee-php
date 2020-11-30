<?php

namespace Shopee;

use function hash_hmac;

class SignatureGenerator implements SignatureGeneratorInterface
{
    private $partnerKey;

    public function __construct(string $partnerKey)
    {
        $this->partnerKey = $partnerKey;
    }

    public function generateSignature(string $url, string $body): string
    {
        $data = $url . '|' . $body;

        return hash_hmac('sha256', $data, $this->partnerKey);
    }
}
