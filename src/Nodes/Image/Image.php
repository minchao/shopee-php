<?php


namespace Shopee\Nodes\Image;


use Shopee\Nodes\NodeAbstract;
use Shopee\ResponseData;

class Image extends NodeAbstract
{
    public function uploadImage($parameters = []): ResponseData
    {
        return $this->post('/api/v1/image/upload', $parameters);
    }
}