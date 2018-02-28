<?php

namespace Shopee\Nodes\Item;

use Shopee\RequestParams;

class AddItemImgParams extends RequestParams
{
    protected $required = [
        'item_id',
        'images',
    ];

    public function getItemId(): ?int
    {
        return $this->params['item_id'];
    }

    /**
     * Set the identity of product item.
     *
     * @param int $itemId
     * @return $this
     */
    public function setItemId(int $itemId)
    {
        $this->params['item_id'] = $itemId;

        return $this;
    }

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
