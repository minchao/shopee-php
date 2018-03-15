<?php

namespace Shopee\Nodes\Item;

use Shopee\RequestParams;

class GetItemDetailParams extends RequestParams
{
    use ItemParameterTrait;

    protected $required = [
        'item_id',
    ];
}
