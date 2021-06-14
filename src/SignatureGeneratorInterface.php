<?php

namespace Shopee;

use Psr\Http\Message\UriInterface;

interface SignatureGeneratorInterface
{
    public function generateSignature(string $url, string $body): string; // Using for V1
    public function generateSignatureShopLevel(UriInterface $path, string $partner_id, string $access_token, string $shop_id): string;
    public function generateSignatureMerchantLevel(UriInterface $path, string $partner_id, string $access_token, string $merchant_id): string;
    public function generateSignaturePublicLevel(UriInterface $path, string $partner_id): string;
}
