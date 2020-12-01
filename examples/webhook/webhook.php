<?php

/**
 * Push Mechanism (WebHook)
 *
 * @see  https://open.shopee.com/documents?module=63&type=2&id=55
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Shopee\SignatureGenerator;
use Slim\Factory\AppFactory;

require __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();
$signatureGenerator = new SignatureGenerator(getenv('PARTNER_KEY'));

$app->post('/webhook', function (Request $request, Response $response) use ($signatureGenerator) {
    $url = (string)$request->getUri();
    $body = $request->getBody()->getContents();

    // Verify push content
    if ($signatureGenerator->generateSignature($url, $body) !== $request->getHeaderLine('Authorization')) {
        error_log('Invalid authorization signature');
        return $response;
    }

    // TODO here to handle your business logic

    // HTTP response must with status code 2xx and empty body
    return $response;
});

$app->run();
