<?php

namespace Shopee;

class RequestParams implements RequestParamsInterface
{
    /** @var array */
    protected $params = [];

    /** @var array */
    protected $required = [];

    public function __construct(array $params = [])
    {
        $this->params = array_merge($this->params, $params);
    }

    /**
     * Check required params
     *
     * @return bool
     */
    public function check(): bool
    {
        foreach ($this->required as $name) {
            if (!array_key_exists($name, $this->params)) {
                return false;
            }
        }

        return true;
    }

    public function toArray(): array
    {
        return $this->params;
    }
}
