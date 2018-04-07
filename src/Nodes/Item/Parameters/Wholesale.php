<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class Wholesale extends RequestParameters
{
    public function getMin(): int
    {
        return $this->parameters['min'];
    }

    /**
     * The min count of this tier wholesale.
     * If the wholesale is not the first one, the min count must equal to max count of last tier plus one.
     *
     * @param int $min
     * @return $this
     */
    public function setMin(int $min)
    {
        $this->parameters['min'] = $min;

        return $this;
    }

    public function getMax(): int
    {
        return $this->parameters['max'];
    }

    /**
     * The max count of this tier wholesale.
     *
     * @param int $max
     * @return $this
     */
    public function setMax(int $max)
    {
        $this->parameters['max'] = $max;

        return $this;
    }

    public function getUnitPrice(): float
    {
        return $this->parameters['unit_price'];
    }

    /**
     * The current price of the wholesale in the listing currency.
     * The price must be cheaper than original price. And if the wholesale is not the first one,
     * the price must be cheaper than previous tier.
     *
     * @param float $unitPrice
     * @return $this
     */
    public function setUnitPrice(float $unitPrice)
    {
        $this->parameters['unit_price'] = $unitPrice;

        return $this;
    }
}
