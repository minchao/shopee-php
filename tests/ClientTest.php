<?php

namespace Shopee\Tests;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\uri_for;
use Psr\Http\Message\UriInterface;
use Shopee\Client;
use PHPUnit\Framework\TestCase;
use Shopee\Exception\Api\BadRequestException;
use Shopee\Exception\Api\ClientException;
use Shopee\Exception\Api\ServerException;

class ClientTest extends TestCase
{
    use HelperTrait;

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
            'httpClient' => new \GuzzleHttp\Client(['ping' => 'pong']),
            'baseUrl' => 'https://galaxy.com/',
            'userAgent' => 'HeartOfGold/Prototype',
        ];

        $client = new Client($config);

        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
        $this->assertEquals('pong', $client->getHttpClient()->getConfig('ping'));
        $this->assertInstanceOf(UriInterface::class, $client->getBaseUrl());
        $this->assertEquals($config['baseUrl'], $client->getBaseUrl()->__toString());
        $this->assertEquals($config['userAgent'], $client->getUserAgent());
    }

    public function testShouldBeOkWhenNewRequest()
    {
        $client = $this->createClient();

        $expected = new Request(
            'POST',
            Client::DEFAULT_BASE_URL . 'orders/detail',
            [
                'Authorization' => '1ea6dc7dea95f4f7da9f5172d1f9320f21f4eda79176395870797905854e57c0',
                'User-Agent' => Client::DEFAULT_USER_AGENT,
                'Content-Type' => 'application/json',
            ],
            '{"partner_id":1,"shopid":10000,"timestamp":1517755590,"ordersn":"160726152598865"}'
        );

        $actual = $client->newRequest(
            'orders/detail',
            [],
            [
                'partner_id' => 1,
                'shopid' => 10000,
                'timestamp' => 1517755590,
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
                'https://galaxy.com',
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

        $expected = uri_for($exceptedUri);
        $actual = $client->newRequest($actualUri)->getUri();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldBeOkWhenSend()
    {
        $expected = new Response(200, [], '"pong"');
        $client = $this->createMockClient();
        $client->addResponse($expected);

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
     * @param string $exception
     */
    public function testThrowExceptionWhenSendIsError(int $statusCode, string $exception)
    {
        $this->expectException($exception);

        $response = new Response($statusCode);
        $client = $this->createMockClient();
        $client->addResponse($response);

        $request = $client->newRequest('ping');
        $client->send($request);
    }
}
