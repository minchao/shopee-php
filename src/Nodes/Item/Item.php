<?php

namespace Shopee\Nodes\Item;

use Shopee\Nodes\NodeAbstract;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Item extends NodeAbstract
{
    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function add($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/get', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addItemImg($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/img/add', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addVariations($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/add_variations', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function delete($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/delete', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function deleteItemImg($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/img/delete', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function deleteVariation($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/delete_variation', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getAttributes($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/attributes/get', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getCategories($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/categories/get', $parameters);
    }

    /**
     * @param array|GetItemDetailParameters $parameters
     * @return ResponseData
     */
    public function getItemDetail($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/get', $parameters);
    }

    /**
     * @param array|GetItemsListParameters $parameters
     * @return ResponseData
     */
    public function getItemsList($parameters = []): ResponseData
    {
        return $this->post('api/v1/items/get', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function insertItemImg($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/img/insert', $parameters);
    }

    /**
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function updateItem($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/update', $parameters);
    }

    /**
     * @param array|UpdatePriceParameters $parameters
     * @return ResponseData
     */
    public function updatePrice($parameters = []): ResponseData
    {
        return $this->post('api/v1/items/update_price', $parameters);
    }

    /**
     * @param array|UpdateStockParameters $parameters
     * @return ResponseData
     */
    public function updateStock($parameters = []): ResponseData
    {
        return $this->post('api/v1/items/update_stock', $parameters);
    }

    /**
     * @param array|UpdateVariationPriceParameters $parameters
     * @return ResponseData
     */
    public function updateVariationPrice($parameters = []): ResponseData
    {
        return $this->post('api/v1/items/update_variation_price', $parameters);
    }

    /**
     * @param array|UpdateVariationStockParameters $parameters
     * @return ResponseData
     */
    public function updateVariationStock($parameters = []): ResponseData
    {
        return $this->post('api/v1/items/update_variation_stock', $parameters);
    }
}
