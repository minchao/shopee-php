<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameterCollection;
use Shopee\RequestParametersInterface;

class Variations extends RequestParameterCollection
{
    /**
     * @param Variation|RequestParametersInterface $parameter
     * @return $this
     */
    public function add(RequestParametersInterface $parameter)
    {
        parent::add($parameter);

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function fromArray(array $parameters)
    {
        foreach ($parameters as $parameter) {
            $this->add(new Variation($parameter));
        }

        return $this;
    }
}
