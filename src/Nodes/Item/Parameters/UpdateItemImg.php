<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class UpdateItemImg extends RequestParameters
{
    use ItemTrait;

    /**
     * @return string[]
     */
    public function getImages(): array
    {
        return $this->parameters['images'];
    }

    /**
     * Set the image URLs of the item.
     * Up to 9 images(12 images for TW mall seller), max 2.0 MB each.Image format accepted: JPG, JPEG, PNG.
     * Suggested dimension: 1024 x 1024 px. Max size: 2MB
     *
     * @param string[] $images
     * @return $this
     */
    public function setImages(array $images)
    {
        $this->parameters['images'] = $images;

        return $this;
    }
}
