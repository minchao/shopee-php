<?php

namespace Shopee;

use function array_map;

abstract class RequestParameterCollection implements RequestParametersInterface
{
    protected $parameters = [];

    public function __construct(array $parameters = [])
    {
        $this->fromArray($parameters);
    }

    /**
     * @param RequestParametersInterface $parameter
     * @return $this
     */
    public function add(RequestParametersInterface $parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    abstract public function fromArray(array $parameters);

    public function toArray(): array
    {
        return array_map(function (RequestParametersInterface $parameter) {
            return $parameter->toArray();
        }, $this->parameters);
    }
}
