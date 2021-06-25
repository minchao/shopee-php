<?php

namespace Shopee\Nodes\Item;

use Shopee\ClientV2;
use Shopee\Nodes\NodeAbstractV2;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Category extends NodeAbstractV2
{
    /**
     * Use this call to get information of shop.
     * https://open.shopee.com/documents?module=92&type=1&id=536&version=2
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getListCategory($parameters = []): ResponseData
    {
        return $this->get('/api/v2/product/get_category', ClientV2::API_TYPE_SHOP, $parameters);
    }

}
