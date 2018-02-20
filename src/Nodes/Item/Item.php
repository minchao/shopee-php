<?php

namespace Shopee\Nodes\Item;

use Shopee\Nodes\NodeAbstract;
use Shopee\RequestParamsInterface;
use Shopee\ResponseData;

class Item extends NodeAbstract
{
    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function add($params): ResponseData
    {
        return $this->post('api/v1/item/get', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function addItemImg($params): ResponseData
    {
        return $this->post('api/v1/item/img/add', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function addVariations($params): ResponseData
    {
        return $this->post('api/v1/item/add_variations', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function delete($params): ResponseData
    {
        return $this->post('api/v1/item/delete', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function deleteItemImg($params): ResponseData
    {
        return $this->post('api/v1/item/img/delete', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function deleteVariation($params): ResponseData
    {
        return $this->post('api/v1/item/delete_variation', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function getAttributes($params): ResponseData
    {
        return $this->post('api/v1/item/attributes/get', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function getCategories($params): ResponseData
    {
        return $this->post('api/v1/item/categories/get', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function getItemDetail($params): ResponseData
    {
        return $this->post('api/v1/item/get', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function getItemsList($params): ResponseData
    {
        return $this->post('api/v1/items/get', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function insertItemImg($params): ResponseData
    {
        return $this->post('api/v1/item/img/insert', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function updateItem($params): ResponseData
    {
        return $this->post('api/v1/item/update', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function updatePrice($params): ResponseData
    {
        return $this->post('api/v1/items/update_price', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function updateStock($params): ResponseData
    {
        return $this->post('api/v1/items/update_stock', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function updateVariationPrice($params): ResponseData
    {
        return $this->post('api/v1/items/update_variation_price', $params);
    }

    /**
     * @param array|RequestParamsInterface $params
     * @return ResponseData
     */
    public function updateVariationStock($params): ResponseData
    {
        return $this->post('api/v1/items/update_variation_stock', $params);
    }
}
