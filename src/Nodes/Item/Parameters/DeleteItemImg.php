<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class DeleteItemImg extends RequestParameters
{
    use ItemTrait;

    /**
     * @return string[]|null
     */
    public function getImages(): ?array
    {
        return $this->parameters['images'];
    }

    /**
     * @param string[] $images
     * @return $this
     */
    public function setImages(array $images)
    {
        $this->parameters['images'] = $images;

        return $this;
    }

    /**
     * @return int[]|null
     */
    public function getPositions(): ?array
    {
        return $this->parameters['positions'];
    }

    /**
     * @param int[] $positions
     * @return $this
     */
    public function setPositions(array $positions)
    {
        $this->parameters['positions'] = $positions;

        return $this;
    }
}
