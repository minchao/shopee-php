<?php

namespace Shopee;

abstract class RequestParameters implements RequestParametersInterface
{
    /**
     * @var array
     */
    protected $parameters = [];

    public function __construct(array $parameters = [])
    {
        $this->fromArray($parameters);
    }

    protected function toCamelcase(string $name, bool $lcfirst = false): string
    {
        $name = str_replace('_', '', ucwords($name, '_'));

        if ($lcfirst) {
            $name = lcfirst($name);
        }

        return $name;
    }

    public function fromArray(array $parameters): void
    {
        foreach ($parameters as $key => $var) {
            $setMethod = sprintf('set%s', $this->toCamelcase($key, true));
            if (method_exists($this, $setMethod)) {
                $this->$setMethod($parameters[$key]);

                continue;
            }

            $this->parameters[$key] = $var;
        }
    }

    public function toArray(): array
    {
        ksort($this->parameters);

        return array_map(function ($value) {
            if ($value instanceof RequestParametersInterface) {
                return $value->toArray();
            }
            return $value;
        }, $this->parameters);
    }
}
