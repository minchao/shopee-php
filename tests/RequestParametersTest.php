<?php

namespace Shopee\Tests;

use PHPUnit\Framework\TestCase;
use Shopee\RequestParametersInterface;

class RequestParametersTest extends TestCase
{
    protected function newInstance($parameters = [])
    {
        return new RequestParametersClass($parameters);
    }

    public function testShouldBeOkWhenNewInstance()
    {
        $target = $this->newInstance();

        $this->assertInstanceOf(RequestParametersInterface::class, $target);
    }

    public function testShouldReturnDefaultsWhenNewInstanceWithNoParameters()
    {
        $target = $this->newInstance();

        $expected = [
            'parameter' => 1,
        ];
        $actual = $target->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldBeOkWhenNewInstanceFromArray()
    {
        $expected = [
            'parameter' => 1000,
            'test_camelcase_parameter' => 'camelcase',
        ];

        $target = $this->newInstance($expected);
        $actual = $target->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldBeOkWhenNewInstanceWithSetMethods()
    {
        $target = ($this->newInstance())
            ->setParameter(1000)
            ->setTestCamelcaseParameter('camelcase');

        $expected = [
            'parameter' => 1000,
            'test_camelcase_parameter' => 'camelcase',
        ];
        $actual = $target->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldBeOkWhenNewInstanceWithObject()
    {
        $target = $this->newInstance();
        $target->setObjectParameter(new RequestParametersClass(['parameter' => 1000]));

        $expected = [
            'parameter' => 1,
            'object_parameter' => [
                'parameter' => 1000,
            ],
        ];
        $actual = $target->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldBeOkWhenNewInstanceWithUnimplementedParameters()
    {
        $expected = [
            'parameter' => 1000,
            'unimplemented_parameters' => 'unimplemented',
        ];
        $target = $this->newInstance($expected);

        $actual = $target->toArray();

        $this->assertEquals($expected, $actual);
    }
}
