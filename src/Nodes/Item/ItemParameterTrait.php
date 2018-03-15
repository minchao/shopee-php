<?php

namespace Shopee\Nodes\Item;

trait ItemParameterTrait
{
    public function getItemId(): ?int
    {
        return $this->params['item_id'];
    }

    /**
     * Set the Shopee's unique identifier for an item
     *
     * @param int $itemId
     * @return $this
     */
    public function setItemId(int $itemId)
    {
        $this->params['item_id'] = $itemId;

        return $this;
    }
}
