<?php

namespace Shopee\Nodes\Shop;

use Shopee\ClientV2;
use Shopee\Nodes\NodeAbstractV2;
use Shopee\ResponseData;

class Authorization extends NodeAbstractV2
{

    /**
     * Shop performance includes the indexes from "My Performance" of Seller Center.
     *
     * @param $auth_code
     * @param $partner_id
     * @param $shop_id
     * @return ResponseData
     */
    public function getAccessToken($auth_code, $partner_id, $shop_id): ResponseData
    {
        return $this->post('/api/v2/auth/token/get', ClientV2::API_TYPE_PUBLIC, [
            'code' => $auth_code,
            'partner_id' => $partner_id,
            'shop_id' => $shop_id
        ]);
    }

    /**
     * Only for TW whitelisted shop.Use this API to set the installment status of shop.
     *
     * @param $partner_id
     * @param $shop_id
     * @param $refresh_token
     * @return ResponseData
     */
    public function refreshAccessToken($partner_id, $shop_id, $refresh_token): ResponseData
    {
        return $this->post('/api/v2/auth/access_token/get', ClientV2::API_TYPE_PUBLIC, [
            'partner_id' => $partner_id,
            'shop_id' => $shop_id,
            'refresh_token' => $refresh_token
        ]);
    }

}
