<?php

namespace Shopee;

class RequestParams implements RequestParamsInterface
{
    /** @var array */
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function toArray(): array
    {
        $this->params;
    }
}
