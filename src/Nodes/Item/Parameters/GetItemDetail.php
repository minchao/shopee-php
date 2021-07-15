<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class GetItemDetail extends RequestParameters
{
    public function getItemIdList(): int
    {
        return $this->parameters['item_id_list'];
    }

    /**
     * Set the Shopee's unique identifier for an item
     *
     * @param array $itemIdList
     * @return $this
     */
    public function setItemIdList($itemIdList)
    {
        $this->parameters['item_id_list'] = $itemIdList;

        return $this;
    }
}
