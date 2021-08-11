<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class GetRecommendCats extends RequestParameters
{

    public function getName(): string
    {
        return $this->parameters['item_name'];
    }

    /**
     * Name of the item in local language.
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->parameters['item_name'] = $name;

        return $this;
    }
}
