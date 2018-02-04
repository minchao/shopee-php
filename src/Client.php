<?php

namespace Shopee;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

class Client
{
    const VERSION = '0.0.0';

    const DEFAULT_BASE_URL = 'https://partner.shopeemobile.com/api/v1/';

    const DEFAULT_USER_AGENT = 'shopee-php/' . self::VERSION;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var UriInterface
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $userAgent;

    public function __construct(array $config = [])
    {
        $config = array_merge([
            'httpClient' => null,
            'baseUrl' => self::DEFAULT_BASE_URL,
            'userAgent' => self::DEFAULT_USER_AGENT,
        ], $config);

        $this->httpClient = $config['httpClient'] ?: new \GuzzleHttp\Client();
        $this->setBaseUrl($config['baseUrl']);
        $this->setUserAgent($config['userAgent']);
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getBaseUrl(): UriInterface
    {
        return $this->baseUrl;
    }

    public function setBaseUrl(string $url): self
    {
        $this->baseUrl = new Uri($url);

        return $this;
    }
}
