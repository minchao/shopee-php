<?php

namespace Shopee;

use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use function hash_hmac;
use Psr\Http\Message\UriInterface;

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

    public function generateSignatureShopLevel(UriInterface $uri, string $partner_id, string $access_token, string $shop_id): string
    {
        $time_st = time();
        $path = $uri->getPath();
        $data = $partner_id . $path . $time_st . $access_token . $shop_id;
        $sign = hash_hmac('sha256', $data, $this->partnerKey);
        $path = Uri::withQueryValues($uri, [
            'partner_id' => $partner_id,
            'shop_id' => $shop_id,
            'timestamp' => $time_st,
            'access_token' => $access_token,
            'sign' => $sign
        ]);
        return $path->getQuery();
    }

    public function generateSignatureMerchantLevel(UriInterface $uri, string $partner_id, string $access_token, string $merchant_id): string
    {
        $time_st = time();
        $path = $uri->getPath();
        $data = $partner_id . $path . $time_st . $access_token . $merchant_id;
        $sign =  hash_hmac('sha256', $data, $this->partnerKey);
        $path = Uri::withQueryValues($uri, [
            'partner_id' => $partner_id,
            'merchant_id' => $partner_id,
            'timestamp' => $time_st,
            'access_token' => $partner_id,
            'sign' => $sign
        ]);
        return $path->getQuery();
    }

    public function generateSignaturePublicLevel(UriInterface $uri, string $partner_id): string
    {
        $time_st = time();
        $path = $uri->getPath();
        $data = $partner_id . $path . $time_st;
        $sign =  hash_hmac('sha256', $data, $this->partnerKey);
        $path = Uri::withQueryValues($uri, [
            'partner_id' => $partner_id,
            'timestamp' => $time_st,
            'sign' => $sign
        ]);
        return $path->getQuery();
    }
}
