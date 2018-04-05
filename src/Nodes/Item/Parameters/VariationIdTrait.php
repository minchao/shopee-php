<?php

namespace Shopee\Nodes\Item\Parameters;

trait VariationIdTrait
{
    public function getVariationId(): int
    {
        return $this->parameters['variation_id'];
    }

    /**
     * Shopee's unique identifier for a variation of an item.
     * Please input the variation_id of a variation to be changed.
     * The variation_id and item_id pair must be matched in order to perform the update.
     *
     * @param int $variationId
     * @return $this
     */
    public function setVariationId(int $variationId)
    {
        $this->parameters['variation_id'] = $variationId;

        return $this;
    }
}
