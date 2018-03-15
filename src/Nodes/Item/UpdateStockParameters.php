<?php

namespace Shopee\Nodes\Item;

use Shopee\RequestParameters;

class UpdateStockParameters extends RequestParameters
{
    use ItemParameterTrait;

    protected $required = [
        'item_id',
        'stock',
    ];

    public function getStock(): ?int
    {
        return $this->parameters['stock'];
    }

    /**
     * Specify the updated stock quantity.
     *
     * @param int $stock
     * @return $this
     */
    public function setStock(int $stock)
    {
        $this->parameters['stock'] = $stock;

        return $this;
    }
}
