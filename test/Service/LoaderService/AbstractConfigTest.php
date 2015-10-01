<?php

namespace Cekurte\Silex\Translation\Test\Service\LoaderService;

use Cekurte\Tdd\ReflectionTestCase;

class AbstractConfigTest extends ReflectionTestCase
{
    public function testImplementsConfigInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ConfigInterface'
        ));
    }

    public function testIsAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig'
        );

        $this->assertTrue($reflection->isAbstract());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The type can not be empty
     */
    public function testSetTypeCanNotBeEmpty()
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $config->setType([]);
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The type must be one element only
     */
    public function testSetTypeCountMustBeEqualsOne()
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $config->setType([[], []]);
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The type key must be a string
     */
    public function testSetTypeKeyMustBeString()
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $config->setType(['fake']);
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The type value must be a string
     */
    public function testSetTypeValueMustBeString()
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $config->setType(['fake' => 0]);
    }

    /**
     * @expectedException              \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^The type "\w+" is invalid\, use one of this types .*?\.$/
     */
    public function testSetTypeInvalid()
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $config->setType(['fake' => 'FakeClass']);
    }

    public function dataProviderTestSetTypeValid()
    {
        $trait = $this
            ->getMockForTrait('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ConfigTrait')
        ;

        $keys = array_keys($trait->getAllowedConfigTypes());

        array_walk($keys, function (&$item) {
            $item = [$item];
        });

        return $keys;
    }

    /**
     * @dataProvider dataProviderTestSetTypeValid
     */
    public function testSetTypeAsString($type)
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $this->assertInstanceOf(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ConfigInterface',
            $config->setTypeAsString($type)
        );

        $this->assertEquals($type, key($config->getType()));

        $this->assertTrue($this->invokeMethod($config, 'isType', [$type]));
    }

    public function dataProviderTestSetAndGetResource()
    {
        return [
            [null],
            ['string'],
            [1],
            [1.2],
            [false],
            [true],
            [[]],
        ];
    }

    /**
     * @dataProvider dataProviderTestSetAndGetResource
     */
    public function testSetAndGetResource($resource)
    {
        $config = $this
            ->getMockBuilder('\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\AbstractConfig')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $this->assertInstanceOf(
            '\\Cekurte\\Silex\\Manager\\Service\\LoaderService\\ConfigInterface',
            $config->setResource($resource)
        );

        $this->assertEquals($resource, $config->getResource());
    }
}
