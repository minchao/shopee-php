<?php

namespace Shopee\Nodes\ShopCategory;

use Shopee\Nodes\NodeAbstract;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class ShopCategory extends NodeAbstract
{
    /**
     * Use this call to add a new collecion.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addShopCategory($parameters = []): ResponseData
    {
        return $this->post('/api/v1/shop_category/add', $parameters);
    }

    /**
     * Use this call to get list of in-shop categories.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getShopCategories($parameters = []): ResponseData
    {
        return $this->post('/api/v1/shop_categorys/get', $parameters);
    }

    /**
     * Use this call to delete a existing collecion.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function deleteShopCategory($parameters = []): ResponseData
    {
        return $this->post('/api/v1/shop_category/delete', $parameters);
    }

    /**
     * Use this call to update a existing collecion.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function updateShopCategory($parameters = []): ResponseData
    {
        return $this->post('/api/v1/shop_category/update', $parameters);
    }

    /**
     * Use this call to add items list to certain shop_category.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addItems($parameters = []): ResponseData
    {
        return $this->post('/api/v1/shop_category/add/items', $parameters);
    }

    /**
     * Use this call to get items list of certain shop_category.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getItems($parameters = []): ResponseData
    {
        return $this->post('/api/v1/shop_category/get/items', $parameters);
    }

    /**
     * Use this api to delete items from shop category.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function deleteItems($parameters = []): ResponseData
    {
        return $this->post('/api/v1/shop_category/del/items', $parameters);
    }
}
