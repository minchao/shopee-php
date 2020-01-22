# shopee-php

[![Build Status](https://travis-ci.org/minchao/shopee-php.svg?branch=master)](https://travis-ci.org/minchao/shopee-php)
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

require_once __DIR__ . '/vendor/autoload.php';

$client = new \Shopee\Client([
    'secret' => SHOPEE_SECRET,
    'partner_id' => SHOPEE_PARTNER_ID,
    'shopid' => SHOPEE_SHOP_ID,
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

## License

See the [LICENSE](LICENSE) file for license rights and limitations (BSD 3-Clause).
