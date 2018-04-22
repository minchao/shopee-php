<?php

namespace Shopee;

use ReflectionClass;

use function array_map;
use function ksort;
use function lcfirst;
use function method_exists;
use function str_replace;
use function ucwords;

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

    /**
     * @param array $parameters
     * @return $this
     * @throws \ReflectionException
     */
    public function fromArray(array $parameters)
    {
        $reflectionClass = new ReflectionClass($this);

        foreach ($parameters as $name => $parameter) {
            $method = 'set' . $this->toCamelcase($name, true);
            if (method_exists($this, $method)) {
                $reflectionMethod = $reflectionClass->getMethod($method);
                $parameterType = $reflectionMethod->getParameters()[0]->getType();
                if ($parameterType && !$parameterType->isBuiltin()) {
                    $className = $parameterType->getName();
                    $parameter = new $className($parameter);
                }

                $this->$method($parameter);

                continue;
            }

            $this->parameters[$name] = $parameter;
        }

        return $this;
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
