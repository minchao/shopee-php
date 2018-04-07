<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameterCollection;
use Shopee\RequestParametersInterface;

class Attributes extends RequestParameterCollection
{
    /**
     * @param Attribute|RequestParametersInterface $parameter
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
            $this->add(new Attribute($parameter));
        }

        return $this;
    }
}
