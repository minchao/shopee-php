<?php

namespace Shopee\Nodes\Item;

use Shopee\RequestParameters;

class GetItemDetailParameters extends RequestParameters
{
    use ItemParameterTrait;

    protected $required = [
        'item_id',
    ];
}
