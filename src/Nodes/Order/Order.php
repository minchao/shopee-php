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
        return $this->post('/api/v1/orders/my_income', $parameters);
    }

    /**
     * Use this api to get orders' release time and escrow amount.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getEscrowReleasedOrders($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/get_escrow_detail', $parameters);
    }

    /**
     * Use this call to retrieve detailed information of all the fulfill orders(forder) under a single regular order
     * based on ordersn.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getForderInfo($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/forder/get', $parameters);
    }

    /**
     * Use this call to retrieve detailed information about one or more orders based on OrderIDs.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getOrderDetails($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/detail', $parameters);
    }

    /**
     * GetOrdersByStatus is the recommended call to use for order management.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getOrdersByStatus($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/get', $parameters);
    }

    /**
     * GetOrdersList is the recommended call to use for order management.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getOrdersList($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/basics', $parameters);
    }

    /**
     * Use this call to accept buyer cancellation.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function acceptBuyerCancellation($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/buyer_cancellation/accept', $parameters);
    }

    /**
     * Use this call to add note for an order.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function addOrderNote($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/note/add', $parameters);
    }

    /**
     * Use this call to cancel an order.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function cancelOrder($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/cancel', $parameters);
    }

    /**
     * Use this call to reject buyer cancellation.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function rejectBuyerCancellation($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/buyer_cancellation/reject', $parameters);
    }

    /**
     * Use this API to split order into fulfillment orders.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function splitOrder($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/split', $parameters);
    }

    /**
     * Use this API to cancel split order from the seller side.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function undoSplitOrder($parameters = []): ResponseData
    {
        return $this->post('/api/v1/orders/unsplit', $parameters);
    }
}
