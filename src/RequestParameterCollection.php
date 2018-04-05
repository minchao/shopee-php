<?php

namespace Shopee;

abstract class RequestParameterCollection implements RequestParametersInterface
{
    protected $parameters = [];

    public function clear(): void
    {
        $this->parameters = [];
    }

    public function add(RequestParametersInterface $parameter)
    {
        $this->parameters[] = $parameter;
    }

    abstract public function addFromArray(array $parameter);

    public function fromArray(array $parameters): void
    {
        foreach ($parameters as $parameter) {
            $this->addFromArray($parameter);
        }
    }

    public function toArray(): array
    {
        return array_map(function (RequestParametersInterface $parameter) {
            return $parameter->toArray();
        }, $this->parameters);
    }
}
