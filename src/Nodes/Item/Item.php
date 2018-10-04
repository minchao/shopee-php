<?php

namespace Shopee\Nodes\Item;

use Shopee\Nodes\NodeAbstract;
use Shopee\ResponseData;

class Item extends NodeAbstract
{
    /**
     * Use this call to add a product item.
     *
     * @param array|Parameters\Add $parameters
     * @return ResponseData
     */
    public function add($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/add', $parameters);
    }

    /**
     * Use this call to add product item images.
     *
     * @param array|Parameters\AddItemImg $parameters
     * @return ResponseData
     */
    public function addItemImg($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/img/add', $parameters);
    }

    /**
     * Use this call to add item variations.
     *
     * @param array|Parameters\AddVariations $parameters
     * @return ResponseData
     */
    public function addVariations($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/add_variations', $parameters);
    }

    /**
     * Use this call to delete a product item.
     *
     * @param array|Parameters\Delete $parameters
     * @return ResponseData
     */
    public function delete($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/delete', $parameters);
    }

    /**
     * Use this call to delete a product item image.
     *
     * @param array|Parameters\DeleteItemImg $parameters
     * @return ResponseData
     */
    public function deleteItemImg($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/img/delete', $parameters);
    }

    /**
     * Use this call to delete item variation.
     *
     * @param array|Parameters\DeleteVariation $parameters
     * @return ResponseData
     */
    public function deleteVariation($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/delete_variation', $parameters);
    }

    /**
     * Use this call to get attributes of product item.
     *
     * @param array|Parameters\GetAttributes $parameters
     * @return ResponseData
     */
    public function getAttributes($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/attributes/get', $parameters);
    }

    /**
     * Use this call to get categories of product item.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function getCategories($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/categories/get', $parameters);
    }

    /**
     * Use this call to get detail of item.
     *
     * @param array|Parameters\GetItemDetail $parameters
     * @return ResponseData
     */
    public function getItemDetail($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/get', $parameters);
    }

    /**
     * Use this call to get a list of items.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function getItemsList($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/get', $parameters);
    }

    /**
     * Use this call to add one item image in assigned position.
     *
     * @param array|Parameters\InsertItemImg $parameters
     * @return ResponseData
     */
    public function insertItemImg($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/img/insert', $parameters);
    }

    /**
     * Use this call to update a product item.
     *
     * @param array|Parameters\UpdateItem $parameters
     * @return ResponseData
     */
    public function updateItem($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/update', $parameters);
    }

    /**
     * Use this call to update item price.
     *
     * @param array|Parameters\UpdatePrice $parameters
     * @return ResponseData
     */
    public function updatePrice($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update_price', $parameters);
    }

    /**
     * Use this call to update item stock.
     *
     * @param array|Parameters\UpdateStock $parameters
     * @return ResponseData
     */
    public function updateStock($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update_stock', $parameters);
    }

    /**
     * Use this call to update item variation price.
     *
     * @param array|Parameters\UpdateVariationPrice $parameters
     * @return ResponseData
     */
    public function updateVariationPrice($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update_variation_price', $parameters);
    }

    /**
     * Use this call to update item variation stock.
     *
     * @param array|Parameters\UpdateVariationStock $parameters
     * @return ResponseData
     */
    public function updateVariationStock($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update_variation_stock', $parameters);
    }
}
