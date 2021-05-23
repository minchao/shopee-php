<?php

namespace Shopee\Nodes\Push;

use Shopee\Nodes\NodeAbstract;
use Shopee\ResponseData;

class Push extends NodeAbstract
{
    /**
     * Use this API to get the configuration information of push service.
     * @param  array  $parameters
     * @return ResponseData
     */
    public function getPushConfig($parameters = []): ResponseData
    {
        return $this->post('/api/v1/push/get_config', $parameters);
    }

    /**
     * Use this API to set the configuration information of push service.
     * @param  array  $parameters
     * @return ResponseData
     */
    public function setPushConfig($parameters = []): ResponseData
    {
        return $this->post('/api/v1/push/set_config', $parameters);
    }
}
