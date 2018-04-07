<?php

namespace Shopee\Nodes\Order;

use Shopee\Nodes\NodeAbstract;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Order extends NodeAbstract
{
    /**
     * Use this call to retrieve detailed escrow information about one order based on OrderID.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getEscrowDetails($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/my_income', $parameters);
    }

    /**
     * Use this call to retrieve detailed information about one or more orders based on OrderIDs.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getOrderDetails($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/detail', $parameters);
    }

    /**
     * GetOrdersByStatus is the recommended call to use for order management.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getOrdersByStatus($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/get', $parameters);
    }

    /**
     * GetOrdersList is the recommended call to use for order management.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getOrdersList($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/basics', $parameters);
    }

    /**
     * Use this call to accept buyer cancellation.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function acceptBuyerCancellation($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/buyer_cancellation/accept', $parameters);
    }

    /**
     * Use this call to add note for an order.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addOrderNote($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/note/add', $parameters);
    }

    /**
     * Use this call to cancel an order.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function cancelOrder($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/cancel', $parameters);
    }

    /**
     * Use this call to reject buyer cancellation.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function rejectBuyerCancellation($parameters = []): ResponseData
    {
        return $this->post('api/v1/orders/buyer_cancellation/reject', $parameters);
    }
}
