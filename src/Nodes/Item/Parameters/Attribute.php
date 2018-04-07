<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class Attribute extends RequestParameters
{
    public function getAttributeId(): int
    {
        return $this->parameters['attribute_id'];
    }

    /**
     * @param string $attributeId
     * @return $this
     */
    public function setAttributeId(string $attributeId)
    {
        $this->parameters['attribute_id'] = $attributeId;

        return $this;
    }

    public function getValue(): string
    {
        return $this->parameters['value'];
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue(string $value)
    {
        $this->parameters['value'] = $value;

        return $this;
    }
}
