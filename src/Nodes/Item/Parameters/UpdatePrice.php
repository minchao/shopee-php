<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class UpdatePrice extends RequestParameters
{
    use ItemTrait;

    public function getPrice(): float
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
