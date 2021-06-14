<?php

namespace Shopee\Tests;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use InvalidArgumentException;
use Psr\Http\Message\UriInterface;
use Shopee\Client;
use PHPUnit\Framework\TestCase;
use Shopee\ClientV2;
use Shopee\Exception\Api\ApiException;
use Shopee\Exception\Api\BadRequestException;
use Shopee\Exception\Api\ClientException;
use Shopee\Exception\Api\ServerException;
use Shopee\SignatureGenerator;
use Shopee\SignatureGeneratorInterface;
use stdClass;

class ClientV2Test extends TestCase
{
    use ClientTrait;

    public function testCreateClient()
    {
        $client = $this->createClientV2();

        $this->assertInstanceOf(ClientV2::class, $client);
        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
        $this->assertInstanceOf(UriInterface::class, $client->getBaseUrl());
        $this->assertEquals(ClientV2::DEFAULT_BASE_URL, $client->getBaseUrl()->__toString());
        $this->assertEquals(ClientV2::DEFAULT_USER_AGENT, $client->getUserAgent());
    }

    public function testCreateClientWithConfig()
    {
        $config = [
            'httpClient' => new HttpClient(['ping' => 'pong']),
            'baseUrl' => 'https://galaxy.com/',
            'userAgent' => 'HeartOfGold/Prototype',
        ];

        $client = $this->createClientV2($config);

        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
        $this->assertEquals('pong', $client->getHttpClient()->getConfig('ping'));
        $this->assertInstanceOf(UriInterface::class, $client->getBaseUrl());
        $this->assertEquals($config['baseUrl'], $client->getBaseUrl()->__toString());
        $this->assertEquals($config['userAgent'], $client->getUserAgent());
    }

    public function testCreateClientWithInvalidSignatureGenerator()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createClientV2([
            SignatureGeneratorInterface::class => new stdClass(),
        ]);
    }

    public function testShouldBeOkWhenRequestWithCustomSignatureGenerator()
    {
        $signatureGenerator = new class ('PARTNER_KEY') extends SignatureGenerator
        {
            public function generateSignaturePublicLevel(UriInterface $url, string $body): string
            {
                return 'CUSTOM_SIGNATURE';
            }
        };

        $actual = $this->createClientV2([
            SignatureGeneratorInterface::class => $signatureGenerator,
        ])->newRequest('/api/v1/orders/detail', ClientV2::API_TYPE_PUBLIC);

        $this->assertEquals('https://partner.shopeemobile.com/api/v1/orders/detail?CUSTOM_SIGNATURE', $actual->getUri()->__toString());
    }

    public function testShouldBeOkWhenNewRequest()
    {
        $expected = new Request(
            'POST',
            ClientV2::DEFAULT_BASE_URL . '/api/v2/orders/detail?CUSTOM_SIGNATURE',
            [
                'User-Agent' => ClientV2::DEFAULT_USER_AGENT,
                'Content-Type' => 'application/json',
            ],
            '{"partner_id":1,"shopid":61299,"timestamp":1470198856,"ordersn":"160726152598865"}'
        );

        $signatureGenerator = new class ('PARTNER_KEY') extends SignatureGenerator
        {
            public function generateSignaturePublicLevel(UriInterface $url, string $body): string
            {
                return 'CUSTOM_SIGNATURE';
            }
        };

        $object_mock = $this->createClientV2([
            SignatureGeneratorInterface::class => $signatureGenerator
        ]);

        $actual = $object_mock->newRequest(
            '/api/v2/orders/detail',
            ClientV2::API_TYPE_PUBLIC,
            [],
            [
                'partner_id' => 1,
                'shopid' => 61299,
                'timestamp' => 1470198856,
                'ordersn' => '160726152598865',
            ]
        );

        $this->assertEquals($expected->getMethod(), $actual->getMethod());
        $this->assertEquals($expected->getUri(), $actual->getUri());
        $this->assertEquals($expected->getHeaders(), $actual->getHeaders());
        $this->assertEquals($expected->getBody()->getContents(), $actual->getBody()->getContents());
        $this->assertEquals($expected->getProtocolVersion(), $actual->getProtocolVersion());
    }

    public function getRequestUriCases()
    {
        return [
            [
                'https://galaxy.com/',
                '',
                'https://galaxy.com/?test=TEST_SIGNATURE',
            ],
            [
                'https://galaxy.com/',
                'milky-way',
                'https://galaxy.com/milky-way?test=TEST_SIGNATURE',
            ],
            [
                'https://galaxy.com/',
                'milky-way/solar-system',
                'https://galaxy.com/milky-way/solar-system?test=TEST_SIGNATURE',
            ],
            [
                'https://galaxy.com/milky-way/',
                'solar-system',
                'https://galaxy.com/milky-way/solar-system?test=TEST_SIGNATURE',
            ],
            [
                'https://galaxy.com/',
                'milky-way/solar-system?planet=earth',
                'https://galaxy.com/milky-way/solar-system?planet=earth&test=TEST_SIGNATURE',
            ],
        ];
    }

    /**
     * @dataProvider getRequestUriCases
     * @param string $baseUri
     * @param string $actualUri
     * @param string $exceptedUri
     * @throws \Exception
     */
    public function testShouldBeOkWhenNewRequestWithUri(string $baseUri, string $actualUri, string $exceptedUri)
    {
        $signatureGenerator = new class ('PARTNER_KEY') extends SignatureGenerator
        {
            public function generateSignaturePublicLevel(UriInterface $url, string $body): string
            {
                return Uri::withQueryValues($url, [
                    'test' => 'TEST_SIGNATURE',
                ])->getQuery();
            }
        };

        $client = $this->createClientV2([
            'baseUrl' => $baseUri,
            SignatureGeneratorInterface::class => $signatureGenerator
        ]);

        $expected = Utils::uriFor($exceptedUri);
        $actual = $client->newRequest($actualUri, ClientV2::API_TYPE_PUBLIC)->getUri();

        $this->assertEquals($expected, $actual);
    }

    public function getAuthorizationRequestUriCases()
    {
        return [
            [
                'https://galaxy.com',
                'test',
                'https://galaxy.com/api/v2/shop/auth_partner?test=TEST_SIGNATURE&redirect=test',
            ],
            [
                'https://galaxy.com',
                'https://sme.upbase.vn/channel/shopee',
                'https://galaxy.com/api/v2/shop/auth_partner?test=TEST_SIGNATURE&redirect=https://sme.upbase.vn/channel/shopee',
            ],
            [
                'https://galaxy.com',
                'https://sme.upbase.vn/channel/shopee?channel_code=123',
                'https://galaxy.com/api/v2/shop/auth_partner?test=TEST_SIGNATURE&redirect=https://sme.upbase.vn/channel/shopee?channel_code%3D123',
            ],
        ];
    }

    /**
     * @dataProvider getAuthorizationRequestUriCases
     * @param string $baseUri
     * @param string $callback_url
     * @param string $exceptedUri
     */
    public function testAuthorizationUrl(string $baseUri, string $callback_url, string $exceptedUri){
        $signatureGenerator = new class ('PARTNER_KEY') extends SignatureGenerator
        {
            public function generateSignaturePublicLevel(UriInterface $url, string $body): string
            {
                return Uri::withQueryValues($url, [
                    'test' => 'TEST_SIGNATURE',
                ])->getQuery();
            }
        };

        $client = $this->createClientV2([
            'baseUrl' => $baseUri,
            SignatureGeneratorInterface::class => $signatureGenerator
        ]);

        $actual = $client->getAuthorizationUrl($callback_url);

        $this->assertEquals($exceptedUri, $actual);
    }

}
