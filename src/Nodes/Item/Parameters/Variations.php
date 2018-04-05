<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameterCollection;
use Shopee\RequestParametersInterface;

class Variations extends RequestParameterCollection
{
    /**
     * @param Variation|RequestParametersInterface $parameter
     */
    public function add(RequestParametersInterface $parameter)
    {
        parent::add($parameter);
    }

    public function addFromArray(array $parameter)
    {
        $this->add(new Variation($parameter));
    }
}
