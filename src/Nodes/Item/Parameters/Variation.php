<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class Variation extends RequestParameters
{
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

    public function getStock(): int
    {
        return $this->parameters['stock'];
    }

    /**
     * The current stock quantity of the variation in the listing currency.
     *
     * @param int $stock
     * @return $this
     */
    public function setStock(int $stock)
    {
        $this->parameters['stock'] = $stock;

        return $this;
    }

    public function getPrice()
    {
        return $this->parameters['price'];
    }

    /**
     * The current price of the variation in the listing currency.
     *
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price)
    {
        $this->parameters['price'] = $price;

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
