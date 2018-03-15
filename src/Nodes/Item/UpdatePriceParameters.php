<?php

namespace Shopee\Nodes\Item;

use Shopee\RequestParameters;

class UpdatePriceParameters extends RequestParameters
{
    use ItemParameterTrait;

    protected $required = [
        'item_id',
        'price',
    ];

    public function getPrice(): ?float
    {
        return $this->parameters['price'];
    }

    /**
     * Specify the revised price of the item.
     *
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price)
    {
        $this->parameters['price'] = $price;

        return $this;
    }
}
