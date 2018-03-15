<?php

namespace Shopee\Nodes\Item;

class UpdateVariationStockParameters extends UpdateStockParameters
{
    use ItemParameterTrait;
    use VariationIdParameterTrait;

    protected $required = [
        'item_id',
        'stock',
    ];
}
