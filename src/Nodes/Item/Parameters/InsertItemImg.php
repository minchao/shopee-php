<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class InsertItemImg extends RequestParameters
{
    use ItemTrait;

    public function getImageUrl(): string
    {
        return $this->parameters['image_url'];
    }

    /**
     * Image URL of the item.
     *
     * @param string $imageUrl
     * @return $this
     */
    public function setImageUrl(string $imageUrl)
    {
        $this->parameters['image_url'] = $imageUrl;

        return $this;
    }

    public function getImagePosition(): int
    {
        return $this->parameters['image_position'];
    }

    /**
     * The position that insert the image. It starts with 1 and the max number is 9.
     * If the position is bigger than existing position, the image would be placed on the last position.
     *
     * @param int $imagePosition
     * @return $this
     */
    public function setImagePosition(int $imagePosition)
    {
        $this->parameters['image_position'] = $imagePosition;

        return $this;
    }
}
