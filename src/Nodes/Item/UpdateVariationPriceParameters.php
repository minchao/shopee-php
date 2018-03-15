<?php

namespace Shopee\Nodes\Item;

class UpdateVariationPriceParameters extends UpdatePriceParameters
{
    use ItemParameterTrait;
    use VariationIdParameterTrait;

    protected $required = [
        'item_id',
        'price',
    ];
}
