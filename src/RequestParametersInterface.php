<?php

namespace Shopee;

interface RequestParametersInterface
{
    public function fromArray(array $parameters): void;

    public function toArray(): array;
}
