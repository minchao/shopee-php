<?php

namespace Shopee\Nodes\Payment;

use Shopee\Nodes\NodeAbstract;
use Shopee\ResponseData;

class Payment extends NodeAbstract
{
    /**
     * Use this API to get the transaction records of wallet.
     * @param  array  $parameters
     * @return ResponseData
     */
    public function getTransactionList($parameters = []): ResponseData
    {
        return $this->post('/api/v1/wallet/transaction/list', $parameters);
    }

    /**
     * Use this API to fetch the detailed amount of offline adjustment.
     * @param  array  $parameters
     * @return ResponseData
     */
    public function getPayoutDetail($parameters = []): ResponseData
    {
        return $this->post('/api/v1/payment/get_payout_details', $parameters);
    }
}
