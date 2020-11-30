<?php

namespace Shopee\Tests;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use InvalidArgumentException;
use Psr\Http\Message\UriInterface;
use Shopee\Client;
use PHPUnit\Framework\TestCase;
use Shopee\Exception\Api\ApiException;
use Shopee\Exception\Api\BadRequestException;
use Shopee\Exception\Api\ClientException;
use Shopee\Exception\Api\ServerException;
use Shopee\SignatureGenerator;
use Shopee\SignatureGeneratorInterface;
use stdClass;

class ClientTest extends TestCase
{
    use ClientTrait;

    public function testCreateClient()
    {
        $client = $this->createClient();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
        $this->assertInstanceOf(UriInterface::class, $client->getBaseUrl());
        $this->assertEquals(Client::DEFAULT_BASE_URL, $client->getBaseUrl()->__toString());
        $this->assertEquals(Client::DEFAULT_USER_AGENT, $client->getUserAgent());
    }

    public function testCreateClientWithConfig()
    {
        $config = [
            'httpClient' => new HttpClient(['ping' => 'pong']),
            'baseUrl' => 'https://galaxy.com/',
            'userAgent' => 'HeartOfGold/Prototype',
        ];

        $client = $this->createClient($config);

        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
        $this->assertEquals('pong', $client->getHttpClient()->getConfig('ping'));
        $this->assertInstanceOf(UriInterface::class, $client->getBaseUrl());
        $this->assertEquals($config['baseUrl'], $client->getBaseUrl()->__toString());
        $this->assertEquals($config['userAgent'], $client->getUserAgent());
    }

    public function testCreateClientWithInvalidSignatureGenerator()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->createClient([
            SignatureGeneratorInterface::class => new stdClass(),
        ]);
    }

    public function testShouldBeOkWhenRequestWithCustomSignatureGenerator()
    {
        $signatureGenerator = new class ('PARTNER_KEY') extends SignatureGenerator {
            public function generateSignature(string $url, string $body): string
            {
                return 'CUSTOM_SIGNATURE';
            }
        };

        $actual = $this->createClient([
            SignatureGeneratorInterface::class => $signatureGenerator,
        ])->newRequest('/api/v1/orders/detail');

        $this->assertEquals('CUSTOM_SIGNATURE', $actual->getHeaderLine('Authorization'));
    }

    public function testShouldBeOkWhenNewRequest()
    {
        $expected = new Request(
            'POST',
            Client::DEFAULT_BASE_URL . '/api/v1/orders/detail',
            [
                'Authorization' => '7f8239f14aa84c8ff59c61c4b728e08a44f5ff756064da74678b2f5162ac9116',
                'User-Agent' => Client::DEFAULT_USER_AGENT,
                'Content-Type' => 'application/json',
            ],
            '{"partner_id":1,"shopid":61299,"timestamp":1470198856,"ordersn":"160726152598865"}'
        );

        $actual = $this->createClient()->newRequest(
            '/api/v1/orders/detail',
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
                'https://galaxy.com/',
            ],
            [
                'https://galaxy.com/',
                'milky-way',
                'https://galaxy.com/milky-way',
            ],
            [
                'https://galaxy.com/',
                'milky-way/solar-system',
                'https://galaxy.com/milky-way/solar-system',
            ],
            [
                'https://galaxy.com/milky-way/',
                'solar-system',
                'https://galaxy.com/milky-way/solar-system',
            ],
            [
                'https://galaxy.com/',
                'milky-way/solar-system?planet=earth',
                'https://galaxy.com/milky-way/solar-system?planet=earth',
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
        $client = $this->createClient([
            'baseUrl' => $baseUri,
        ]);

        $expected = Utils::uriFor($exceptedUri);
        $actual = $client->newRequest($actualUri)->getUri();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldBeOkWhenSend()
    {
        $expected = new Response(200, [], '"pong"');
        $client = $this->createClient([], $this->createHttpClient($expected));

        $request = $client->newRequest('ping');
        $actual = $client->send($request);

        $this->assertEquals($expected, $actual);
    }

    public function getApiExceptionCases()
    {
        return [
            [
                400,
                BadRequestException::class,
            ],
            [
                403,
                ClientException::class,
            ],
            [
                405,
                ClientException::class,
            ],
            [
                500,
                ServerException::class,
            ],
            [
                503,
                ServerException::class,
            ],
        ];
    }

    /**
     * @dataProvider getApiExceptionCases
     * @param int $statusCode
     * @param string $expected
     * @throws \Exception
     */
    public function testThrowExceptionWhenSendIsError(int $statusCode, string $expected)
    {
        try {
            $response = new Response($statusCode);
            $client = $this->createClient();
            $client->setHttpClient($this->createHttpClient($response));

            $request = $client->newRequest('ping');
            $client->send($request);
        } catch (ApiException $actual) {
            $this->assertInstanceOf($expected, $actual);
            $this->assertEquals($statusCode, $actual->getCode());
            $this->assertInstanceOf(Request::class, $actual->getRequest());
            $this->assertInstanceOf(Response::class, $actual->getResponse());
            $this->assertEquals([], $actual->getContext());
        }
    }

    public function testThrowExceptionWhenCallNotExistsProperty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Property "unknown" not exists');

        $client = $this->createClient();
        $client->unknown;
    }
}
