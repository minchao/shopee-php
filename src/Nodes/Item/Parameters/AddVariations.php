<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class AddVariations extends RequestParameters
{
    use ItemTrait;

    public function __construct(array $parameters = [])
    {
        $this->parameters['variations'] = new Variations();

        parent::__construct($parameters);
    }

    public function getVariations(): Variations
    {
        return $this->parameters['variations'];
    }

    /**
     * The variation of item is to list out all models of this product.
     * For example, iPhone has model of White and Black, then its variations includes "White iPhone" and "Black iPhone".
     *
     * @param array $variations
     * @return $this
     */
    public function setVariations(array $variations)
    {
        $collection = $this->getVariations();
        $collection->clear();
        $collection->fromArray($variations);

        return $this;
    }
}
