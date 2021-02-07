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
     * Use this api to boost multiple items at once.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function boostItem($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/boost', $parameters);
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
     * Use this api to get all boosted items.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function getBoostedItems($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/get_boosted', $parameters);
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
     * Use this api to get comment by shopid/itemid/comment_id
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function getComment($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/comments/get', $parameters);
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
     * Use this api to get ongoing and upcoming promotions.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function getPromotionInfo($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/promotion/get', $parameters);
    }

    /**
     * Use this API to get recommended category ids according to item name.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function getRecommendCats($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/categories/get_recommend', $parameters);
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
     * Use this api to reply comments from buyers in batch.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function replyComments($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/comments/reply', $parameters);
    }

    /**
     * Only for TW whitelisted shop. Use this API to set the installment tenures of items.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function setItemInstallmentTenures($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/installment/set', $parameters);
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
     * Override and update all the existing images of an item.
     *
     * @param array|Parameters\UpdateItemImg $parameters
     * @return ResponseData
     */
    public function updateItemImage($parameters = []): ResponseData
    {
        return $this->post('/api/v1/item/img/update', $parameters);
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
     * Update items price in batch.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function updatePriceBatch($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update/items_price', $parameters);
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
     * Update items stock in batch.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function updateStockBatch($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update/items_stock', $parameters);
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
     * Update variations price in batch.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function updateVariationPriceBatch($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update/vars_price', $parameters);
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

    /**
     * Update variations stock in batch.
     *
     * @param array $parameters
     * @return ResponseData
     */
    public function updateVariationStockBatch($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/update/vars_stock', $parameters);
    }

    /**
     * Use this call to unlist or list items in batch.
     *
     * @param array|Parameters\UpdateVariationStock $parameters
     * @return ResponseData
     */
    public function unlistItem($parameters = []): ResponseData
    {
        return $this->post('/api/v1/items/unlist', $parameters);
    }

    /**
     * For adding 2-tier variations (Forked).
     *
     * @param array|Parameters\InitTierVariation $parameters
     * @return ResponseData
     */
    public function initTierVariation($parameters = []): ResponseData
    {
        return $this->post('api/v1/item/tier_var/init', $parameters);
    }
}
