<?php

namespace Shopee;

class RequestParameters implements RequestParametersInterface
{
    /** @var array */
    protected $parameters = [];

    /** @var array */
    protected $required = [];

    public function __construct(array $parameters = [])
    {
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    /**
     * Check required parameters
     *
     * @return bool
     */
    public function check(): bool
    {
        foreach ($this->required as $name) {
            if (!array_key_exists($name, $this->parameters)) {
                return false;
            }
        }

        return true;
    }

    public function toArray(): array
    {
        return $this->parameters;
    }
}
