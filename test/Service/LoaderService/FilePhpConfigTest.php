<?php

namespace Cekurte\Silex\Translation\Test\Service\LoaderService;

use Cekurte\Silex\Manager\Service\LoaderService\FilePhpConfig;
use Cekurte\Tdd\ReflectionTestCase;

class FilePhpConfigTest extends ReflectionTestCase
{
    public function testImplementsConfigInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\FilePhpConfig'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ConfigInterface'
        ));
    }

    public function testExtendsAbstractConfig()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\FilePhpConfig'
        );

        $this->assertTrue($reflection->isSubclassOf(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig'
        ));
    }

    public function testContructorSetTypeMethodWasCalled()
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\FilePhpConfig')
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
            [[]],
            [null],
            [true],
            [false],
            [1],
            [1.2],
        ];
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The configuration resource must be a valid value.
     *
     * @dataProvider dataProviderTestProcessInvalidArgumentException
     */
    public function testProcessInvalidArgumentException($resource)
    {
        $config = new FilePhpConfig();

        $config->setResource($resource)->process();
    }

    /**
     * @expectedException              \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^The configuration resource file ".*?" not exists\.$/
     */
    public function testProcessInvalidArgumentExceptionFileNotExists()
    {
        $config = new FilePhpConfig();

        $config->setResource('/src/fake/path')->process();
    }

    public function testProcess()
    {
        $config = new FilePhpConfig();

        $config->setResource(realpath(__DIR__ . '/../../Resources/phpfile.php'))->process();
    }
}
