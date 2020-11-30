<?php

namespace Shopee\Tests;

use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;
use Shopee\Exception\InvalidSignatureException;
use Shopee\SignatureGenerator;
use Shopee\VerifySignatureMiddleware;

class VerifySignatureMiddlewareTest extends TestCase
{
    /** @var RequestHandlerInterface */
    protected $mock;

    protected $signatureGenerator;

    public function setUp(): void
    {
        $this->mock = $this->getMockBuilder(RequestHandlerInterface::class)
            ->getMock();
        $this->signatureGenerator = new SignatureGenerator('PARTNER_KEY');
    }

    public function testShouldBeOk()
    {
        $this->mock->expects($this->once())
            ->method('handle');

        $serverRequest = new ServerRequest(
            'GET',
            'http://localhost/webhook',
            [
                'Authorization' => [$this->signatureGenerator->generateSignature('http://localhost/webhook', 'HELLO')],
            ],
            'HELLO'
        );
        $middleware = new VerifySignatureMiddleware($this->signatureGenerator);

        $middleware->process($serverRequest, $this->mock);
    }

    public function testShouldThrowException()
    {
        $this->expectException(InvalidSignatureException::class);
        $this->mock->expects($this->never())
            ->method('handle');

        $serverRequest = new ServerRequest(
            'GET',
            'http://localhost/webhook',
            [
                'Authorization' => ['INVALID_SIGNATURE'],
            ],
            'HELLO'
        );
        $middleware = new VerifySignatureMiddleware($this->signatureGenerator);

        $middleware->process($serverRequest, $this->mock);
    }
}
