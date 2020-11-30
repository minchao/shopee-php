<?php

namespace Shopee;

interface SignatureGeneratorInterface
{
    public function generateSignature(string $url, string $body): string;
}
