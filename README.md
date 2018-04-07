# shopee-php

[![Build Status](https://travis-ci.org/minchao/shopee-php.svg?branch=master)](https://travis-ci.org/minchao/shopee-php)

This is a [Shopee Partner API](https://partner.shopeemobile.com/docs/) Client for PHP.

## Requirements

* PHP >= 7.1
* [Guzzle](http://guzzle.readthedocs.io/en/latest/overview.html#requirements)

## Installation

Execute the following command to get the package:

```
composer require minchao/shopee-php
```

## Usage

Construct a new client, then use to access the Shopee Partner API.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = new \Shopee\Client([
    'secret' => SHOPEE_SECRET,
    'partner_id' => SHOPEE_PARTNER_ID,
    'shopid' => SHOPEE_SHOP_ID, 
]);
```

### Examples

TODO

## License

See the [LICENSE](LICENSE) file for license rights and limitations (BSD 3-Clause).
