<?php

namespace Shopee\Nodes\Shop;

use Shopee\Nodes\NodeAbstract;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Shop extends NodeAbstract
{
    /**
     * Use this call to get information of shop.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getShopInfo($parameters = []): ResponseData
    {
        return $this->post('api/v1/shop/get', $parameters);
    }

    /**
     * Use this call to update information of shop.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function updateShopInfo($parameters = []): ResponseData
    {
        return $this->post('api/v1/shop/update', $parameters);
    }
}
