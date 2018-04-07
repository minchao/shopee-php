<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class VariationForUpdateItem extends RequestParameters
{
    use VariationIdTrait;

    public function getName(): string
    {
        return $this->parameters['name'];
    }

    /**
     * Name of the variation that belongs to the same item.A seller can offer variations of the same item.
     * For example, the seller could create a fixed-priced listing for a t-shirt design and offer the shirt in
     * different colors and sizes. In this case, each color and size combination is a separate variation.
     * Each variation can have a different quantity and price.
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->parameters['name'] = $name;

        return $this;
    }

    public function getVariationSku()
    {
        return $this->parameters['variation_sku'];
    }

    /**
     * A variation SKU (stock keeping unit) is an identifier defined by a seller.
     * It is only intended for the seller's use.
     * Many sellers assign a SKU to an item of a specific type, size, and color, which are variations of one item in
     * Shopee Listings.
     *
     * @param string $variationSku
     * @return $this
     */
    public function setVariationSku(string $variationSku)
    {
        $this->parameters['variation_sku'] = $variationSku;

        return $this;
    }
}
