<?php

namespace Shopee\Nodes\Logistics;

use Shopee\Nodes\NodeAbstract;
use Shopee\RequestParametersInterface;
use Shopee\ResponseData;

class Logistics extends NodeAbstract
{
    /**
     * Use this call to get all required param for init logistic.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getAddress($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/address/get', $parameters);
    }

    /**
     * Use this API to get airway bill for orders.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getAirwayBill($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/airway_bill/get_mass', $parameters);
    }

    /**
     * Use this call to get all required param for init logistic.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getBranch($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/branch/get', $parameters);
    }

    /**
     * Use this API to get airwaybill for fulfillment orders.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getForderWaybill($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/forder_waybill/get_mass', $parameters);
    }

    /**
     * Use this call to get all supported Logistic Channel.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getLogistics($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/channel/get', $parameters);
    }

    /**
     * Get all the logistics info of an order to Init.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getLogisticInfo($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/init_info/get', $parameters);
    }

    /**
     * Use this call to get the logistics tracking information of an order.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getLogisticsMessage($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/tracking', $parameters);
    }

    /**
     * Use this call to fetch the logistics information of an order, these info can be used for waybill printing.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getOrderLogistics($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/order/get', $parameters);
    }

    /**
     * Use this call to get all required param for init logistic.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getParameterForInit($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/init_parameter/get', $parameters);
    }

    /**
     * Use this call to get all required param for init logistic.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getTimeSlot($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/timeslot/get', $parameters);
    }

    /**
     * Use this API to get tracking number of orders.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function getTrackingNo($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/tracking_number/get_mass', $parameters);
    }

    /**
     * Use this call to arrange Pickup, Dropoff or shipment for non-integrated logistic channels.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function init($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/init', $parameters);
    }

    /**
     * Set Logistic Status to PICKUP_DONE, this API only works for non-integrated logistic channels.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function setLogisticStatus($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/offline/set', $parameters);
    }

    /**
     * Use this call to set tracking number for each order in batch.
     *
     * @param array|RequestParametersInterface $parameters
     * @return ResponseData
     */
    public function setTrackingNo($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/tracking_number/set_mass', $parameters);
    }

    /**
     * Configure shop level logistics.
     *
     * @param array|RequestParametersInterface $parameters $parameters
     * @return ResponseData
     */
    public function updateShopLogistics($parameters = []): ResponseData
    {
        return $this->post('/api/v1/logistics/channels/update', $parameters);
    }
}
