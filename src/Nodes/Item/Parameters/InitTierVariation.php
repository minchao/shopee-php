<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class InitTierVariation extends RequestParameters
{
    use CategoryIdTrait;

    public function getTierVariation()
    {
        return $this->parameters['tier_variation'];
    }

    public function getVariation()
    {
        return $this->parameters['variation'];
    }
}
