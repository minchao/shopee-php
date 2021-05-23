<?php

namespace Shopee\Nodes\Image;

use Shopee\Nodes\NodeAbstract;
use Shopee\ResponseData;

class Image extends NodeAbstract
{
    /**
     * Use this optional API to pre-validate your image urls and convert them to Shopee image url to use in item
     * upload APIs.
     * This way your potential invalid urls will not block your item upload process.
     * @param  array  $parameters
     * @return ResponseData
     */
    public function uploadImage($parameters = []): ResponseData
    {
        return $this->post('/api/v1/image/upload', $parameters);
    }
}
