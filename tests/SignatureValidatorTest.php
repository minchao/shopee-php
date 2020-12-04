<?php

namespace Shopee\Tests;

use GuzzleHttp\Psr7\ServerRequest;
use PHPStan\Testing\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Shopee\SignatureGenerator;
use Shopee\SignatureValidator;

class SignatureValidatorTest extends TestCase
{
    protected $signatureGenerator;

    protected $validator;

    public function setUp(): void
    {
        $this->signatureGenerator = new SignatureGenerator('PARTNER_KEY');
        $this->validator = new SignatureValidator($this->signatureGenerator);
    }

    protected function createServerRequest(string $authorization): ServerRequestInterface
    {
        return new ServerRequest(
            'GET',
            'http://localhost/webhook',
            [
                'Authorization' => [$authorization],
            ],
            'HELLO'
        );
    }

    public function testShouldBeOk(): void
    {
        $serverRequest = $this->createServerRequest(
            $this->signatureGenerator->generateSignature('http://localhost/webhook', 'HELLO')
        );

        $actual = $this->validator->isValid($serverRequest);

        $this->assertTrue($actual);
    }

    public function testShouldReturnFalseWhenSignatureIsEmpty(): void
    {
        $serverRequest = $this->createServerRequest('');

        $actual = $this->validator->isValid($serverRequest);

        $this->assertFalse($actual);
    }

    public function testShouldReturnFalseWhenSignatureIsInvalid(): void
    {
        $serverRequest = $this->createServerRequest('InvalidSignature');

        $actual = $this->validator->isValid($serverRequest);

        $this->assertFalse($actual);
    }
}
