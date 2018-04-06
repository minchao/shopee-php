<?php

namespace Shopee;

interface RequestParametersInterface
{
    /**
     * @param array $parameters
     * @return $this
     */
    public function fromArray(array $parameters);

    public function toArray(): array;
}
