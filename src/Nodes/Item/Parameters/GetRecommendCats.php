<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class GetRecommendCats extends RequestParameters
{
    use CategoryIdTrait;

    public function getName(): string
    {
        return $this->parameters['name'];
    }

    /**
     * Name of the item in local language.
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->parameters['name'] = $name;

        return $this;
    }
}
