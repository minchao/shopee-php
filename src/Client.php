<?php

namespace Shopee;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Exception\ServerException as GuzzleServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use function GuzzleHttp\Psr7\uri_for;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Shopee\Exception\Api\AuthException;
use Shopee\Exception\Api\BadRequestException;
use Shopee\Exception\Api\ClientException;
use Shopee\Exception\Api\Factory;
use Shopee\Exception\Api\ServerException;

class Client
{
    public const VERSION = '0.0.0';

    public const DEFAULT_BASE_URL = 'https://partner.shopeemobile.com/api/v1/';

    public const DEFAULT_USER_AGENT = 'shopee-php/' . self::VERSION;

    public const ENV_SECRET_NAME = 'SHOPEE_API_SECRET';

    public const ENV_PARTNER_ID_NAME = 'SHOPEE_PARTNER_ID';

    public const ENV_SHOP_ID_NAME = 'SHOPEE_SHOP_ID';

    /** @var ClientInterface */
    protected $httpClient;

    /** @var UriInterface */
    protected $baseUrl;

    /** @var string */
    protected $userAgent;

    /** @var string Shopee Partner Secret key */
    protected $secret;

    /** @var int */
    protected $partnerId;

    /** @var int */
    protected $shopId;

    public function __construct(array $config = [])
    {
        $config = array_merge([
            'httpClient' => null,
            'baseUrl' => self::DEFAULT_BASE_URL,
            'userAgent' => self::DEFAULT_USER_AGENT,
            'secret' => getenv(self::ENV_SECRET_NAME),
            'partner_id' => getenv(self::ENV_PARTNER_ID_NAME),
            'shopid' => getenv(self::ENV_SHOP_ID_NAME),
        ], $config);

        $this->httpClient = $config['httpClient'] ?: new \GuzzleHttp\Client();
        $this->setBaseUrl($config['baseUrl']);
        $this->setUserAgent($config['userAgent']);
        $this->secret = $config['secret'];
        $this->partnerId = $config['partner_id'];
        $this->shopId = $config['shopid'];
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

    /**
     * Create HTTP JSON body
     *
     * The HTTP body should contain a serialized JSON string only
     *
     * @param array $data
     * @return string
     */
    protected function createJsonBody(array $data): string
    {
        $data = array_merge([
            'partner_id' => $this->partnerId,
            'shopid' => $this->shopId,
            'timestamp' => time(), // Put the current UNIX timestamp when making a request
        ], $data);

        return json_encode($data);
    }

    /**
     * Generate an HMAC-SHA256 signature for a HTTP request
     *
     * @param UriInterface $uri
     * @param string $body
     * @return string
     */
    protected function signature(UriInterface $uri, string $body): string
    {
        $path = $uri->getScheme() . $uri->getHost() . $uri->getPath();
        $data = $path . '|' . $body;

        // HMAC-SHA256
        return hash_hmac('sha256', $data, $this->secret);
    }

    /**
     * @param string|UriInterface $uri
     * @param array $headers
     * @param array $data
     * @return RequestInterface
     */
    public function newRequest($uri, array $headers = [], $data = []): RequestInterface
    {
        $uri = uri_for($uri);
        $path = rtrim($this->baseUrl->getPath() . $uri->getPath(), '/');

        $uri = $uri
            ->withScheme($this->baseUrl->getScheme())
            ->withUserInfo($this->baseUrl->getUserInfo())
            ->withHost($this->baseUrl->getHost())
            ->withPort($this->baseUrl->getPort())
            ->withPath($path);

        $jsonBody = $this->createJsonBody($data);

        $headers['Authorization'] = $this->signature($uri, $jsonBody);
        $headers['User-Agent'] = $this->userAgent;
        $headers['Content-Type'] = 'application/json';

        return new Request(
            'POST', // All APIs should use POST method
            $uri,
            $headers,
            $jsonBody
        );
    }

    public function send(RequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->httpClient->send($request);
        } catch (GuzzleClientException $exception) {
            switch ($exception->getCode()) {
                case 400:
                    $className = BadRequestException::class;
                    break;
                case 403:
                    $className = AuthException::class;
                    break;
                default:
                    $className = ClientException::class;
            }

            throw Factory::create($className, $exception);
        } catch (GuzzleServerException $exception) {
            throw Factory::create(ServerException::class, $exception);
        }

        return $response;
    }
}
