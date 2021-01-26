# shopee-php

[![tests](https://github.com/minchao/shopee-php/workflows/tests/badge.svg?branch=master)](https://github.com/minchao/shopee-php/actions?query=workflow%3Atests)
[![Latest Stable Version](https://poser.pugx.org/minchao/shopee-php/v/stable)](https://packagist.org/packages/minchao/shopee-php)
[![Latest Unstable Version](https://poser.pugx.org/minchao/shopee-php/v/unstable)](https://packagist.org/packages/minchao/shopee-php)
[![composer.lock](https://poser.pugx.org/minchao/shopee-php/composerlock)](https://packagist.org/packages/minchao/shopee-php)

This is a [Shopee Partner API](https://open.shopee.com/documents) Client for PHP.

## Requirements

* PHP >= 7.1
* [Composer](https://getcomposer.org/download/)
* [Guzzle](https://guzzle.readthedocs.io/en/latest/overview.html#requirements)

## Installation

Execute the following command to get the package:

```console
$ composer require minchao/shopee-php
```

## Usage

Create an instance of the Shopee client, then use to access the Shopee Partner API.

```php
<?php

use Shopee\Client;

require __DIR__ . '/vendor/autoload.php';

$client = new Client([
    'secret' => getenv('SHOPEE_PARTNER_KEY'),
    'partner_id' => getenv('SHOPEE_PARTNER_ID'),
    'shopid' => getenv('SHOPEE_SHOP_ID'),
]);
```

## Examples

### Get detail of item

```php
$response = $client->item->getItemDetail(['item_id' => 1978]);
```

Alternatively, you can also use the parameter model within request.

```php
$parameters = (new \Shopee\Nodes\Item\Parameters\GetItemDetail())
    ->setItemId(1978);
$response = $client->item->getItemDetail($parameters);
```

### Webhook

Use webhook to receive incoming push notifications:

```php
<?php

/**
 * Push Mechanism (WebHook)
 *
 * @see  https://open.shopee.com/documents?module=63&type=2&id=55
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Shopee\SignatureGenerator;
use Shopee\SignatureValidator;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$signatureGenerator = new SignatureGenerator(getenv('PARTNER_KEY'));
$signatureValidator = new SignatureValidator($signatureGenerator);

$app->post('/webhook', function (Request $request, Response $response) use ($signatureValidator) {
    // Verify push content
    if (!$signatureValidator->isValid($request)) {
        error_log('Invalid authorization signature');
        return $response;
    }

    // TODO here to handle your business logic

    // HTTP response must with status code 2xx and empty body
    return $response;
});

$app->run();
```

## License

See the [LICENSE](LICENSE) file for license rights and limitations (BSD 3-Clause).
