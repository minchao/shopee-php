<?php

namespace Shopee\Nodes\Item;

use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use Shopee\ClientV2;
use Shopee\Nodes\NodeAbstractV2;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Category extends NodeAbstractV2 {
	/**
	 * Use this call to get information of shop.
	 * https://open.shopee.com/documents?module=92&type=1&id=536&version=2
	 * @param array|RequestParametersInterface $parameters
	 * @return ResponseData
	 */
	public function getListCategory($parameters = []): ResponseData {
		return $this->get("/api/v2/product/get_category", ClientV2::API_TYPE_SHOP, $parameters);
	}
	/**
	 * Use this call to get information of shop.
	 * https://open.shopee.com/documents?module=89&type=1&id=702&version=2
	 * @param array|RequestParametersInterface $parameters
	 * @return ResponseData
	 */
	public function getCategoryRecommend($parameters = []): ResponseData {
		return $this->get("/api/v2/product/category_recommend", ClientV2::API_TYPE_SHOP, $parameters);
	}
}
