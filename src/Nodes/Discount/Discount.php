<?php

namespace Shopee\Nodes\Discount;

use Shopee\Nodes\NodeAbstract;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Discount extends NodeAbstract
{
    /**
     * Use this api to add shop discount activity.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addDiscount($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discount/add', $parameters);
    }

    /**
     * Use this api to add shop discount item.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addDiscountItem($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discount/items/add', $parameters);
    }

    /**
     * Use this api to delete one discount activity BEFORE it starts.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function deleteDiscount($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discount/delete', $parameters);
    }

    /**
     * Use this api to delete items of the discount activity.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function deleteDiscountItem($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discount/item/delete', $parameters);
    }

    /**
     * Use this api to get one shop discount activity detail.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getDiscountDetail($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discount/detail', $parameters);
    }

    /**
     * Use this api to get shop discount activity list.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getDiscountsList($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discounts/get', $parameters);
    }

    /**
     * Use this api to update one discount information
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function updateDiscount($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discount/update', $parameters);
    }

    /**
     * Use this api to update items of the discount activity.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function updateDiscountItems($parameters = []): ResponseData
    {
        return $this->post('/api/v1/discount/items/update', $parameters);
    }
}
