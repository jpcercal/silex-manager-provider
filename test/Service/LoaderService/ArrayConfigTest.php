<?php

namespace Cekurte\Silex\Translation\Test\Service\LoaderService;

use Cekurte\Silex\Manager\Service\LoaderService\ArrayConfig;
use Cekurte\Tdd\ReflectionTestCase;

class ArrayConfigTest extends ReflectionTestCase
{
    public function testImplementsConfigInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ArrayConfig'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ConfigInterface'
        ));
    }

    public function testExtendsAbstractConfig()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ArrayConfig'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig'
        ));
    }

    public function testContructorSetTypeMethodWasCalled()
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ArrayConfig')
            ->setMethods(['setType'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $config
            ->expects($this->once())
            ->method('setType')
            ->withAnyParameters()
            ->will($this->returnValue(null))
        ;

        $this->invokeMethod($config, '__construct', ['fake']);
    }

    public function dataProviderTestProcessInvalidArgumentException()
    {
        return [
            [''],
            [null],
            [true],
            [false],
            [1],
            [1.2],
        ];
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The configuration resource must be a array.
     *
     * @dataProvider dataProviderTestProcessInvalidArgumentException
     */
    public function testProcessInvalidArgumentException($resource)
    {
        $config = new ArrayConfig();

        $config->setResource($resource)->process();
    }

    public function testProcess()
    {
        $config = new ArrayConfig();

        $config->setResource([])->process();
    }
}
