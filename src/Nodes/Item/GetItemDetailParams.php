<?php

namespace Shopee\Nodes\Item;

use Shopee\RequestParams;

class GetItemDetailParams extends RequestParams
{
    protected $required = [
        'item_id',
    ];

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
