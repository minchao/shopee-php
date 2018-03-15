<?php

namespace Shopee\Nodes\Item;

use Shopee\RequestParams;

class AddItemImgParams extends RequestParams
{
    use ItemParameterTrait;

    protected $required = [
        'item_id',
        'images',
    ];

    public function getImages(): ?array
    {
        return $this->params['images'];
    }

    /**
     * Set the image URLs of the item.
     * It contains at most 9 URLs.Could get the url by api GetItemDetail
     *
     * @param string[] $images
     * @return $this
     */
    public function setImages(array $images)
    {
        $this->params['images'] = $images;

        return $this;
    }
}
