<?php

namespace Shopee\Nodes\Shop;

use Shopee\ClientV2;
use Shopee\Nodes\NodeAbstractV2;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Shop extends NodeAbstractV2
{
    /**
     * Use this call to get information of shop.
     * https://open.shopee.com/documents?module=92&type=1&id=536&version=2
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getShopInfo($parameters = []): ResponseData
    {
        return $this->post('api/v2/shop/get_shop_info', ClientV2::API_TYPE_SHOP, $parameters);
    }

    /**
     *
     * https://open.shopee.com/documents?module=92&type=1&id=584&version=2
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getShopProfile($parameters = []): ResponseData
    {
        return $this->post('/api/v2/shop/get_profile', ClientV2::API_TYPE_SHOP, $parameters);
    }

    /**
     *
     * https://open.shopee.com/documents?module=92&type=1&id=585&version=2
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function updateShopProfile($parameters = []): ResponseData
    {
        return $this->post('/api/v2/shop/update_profile', ClientV2::API_TYPE_SHOP, $parameters);
    }

}
