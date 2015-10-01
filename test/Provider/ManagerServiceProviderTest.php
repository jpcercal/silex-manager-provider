<?php

namespace Cekurte\Silex\Translation\Test\Provider;

use Cekurte\Silex\Manager\Provider\ManagerServiceProvider;
use Cekurte\Tdd\ReflectionTestCase;
use Silex\Application;

class ManagerServiceProviderTest extends ReflectionTestCase
{
    public function testImplementsServiceProviderInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\Silex\\Manager\\Provider\\ManagerServiceProvider'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Silex\\ServiceProviderInterface'
        ));
    }

    public function testRegisterNotIssetServiceProviders()
    {
        $app = new Application();

        $app->register(new ManagerServiceProvider());
    }

    public function testRegisterEmptyServiceProviders()
    {
        $app = new Application();

        $app['cekurte.manager.providers'] = [];

        $app->register(new ManagerServiceProvider());
    }

    public function testRegisterServiceProvidersWithRegisterNotIsset()
    {
        $app = new Application();

        $app['cekurte.manager.providers'] = [
            'Silex\Provider\HttpFragmentServiceProvider'
        ];

        $app->register(new ManagerServiceProvider());

        $app->boot();

        $this->assertFalse(isset($app['fragment.path']));
    }

    public function testRegisterServiceProvidersWithRegisterWithInvalidValue()
    {
        $app = new Application();

        $app['cekurte.manager.providers'] = [
            'Silex\Provider\HttpFragmentServiceProvider' => [
                'register' => 'invalid-value'
            ],
        ];

        $app->register(new ManagerServiceProvider());

        $app->boot();

        $this->assertFalse(isset($app['fragment.path']));
    }

    public function testRegisterServiceProvidersWithRegisterWithValidValue()
    {
        $app = new Application();

        $app['cekurte.manager.providers'] = [
            'Silex\Provider\HttpFragmentServiceProvider' => [
                'register' => true
            ],
        ];

        $app->register(new ManagerServiceProvider());

        $app->boot();

        $this->assertTrue(isset($app['fragment.path']));
    }

    public function testRegisterServiceProvidersWithRegisterWithValidValueAndParameters()
    {
        $app = new Application();

        $app['cekurte.manager.providers'] = [
            'Silex\Provider\HttpFragmentServiceProvider' => [
                'register' => true,
                'type'     => 'array',
                'src'      => [
                    'fragment.path' => 'fake'
                ]
            ],
        ];

        $app->register(new ManagerServiceProvider());

        $app->boot();

        $this->assertEquals('fake', $app['fragment.path']);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRegisterServiceProvidersWithRegisterWithValidValueAndParametersWithTypeError()
    {
        $app = new Application();

        $app['cekurte.manager.providers'] = [
            'Silex\Provider\HttpFragmentServiceProvider' => [
                'register' => true,
                'type'     => 'invalid-value',
            ],
        ];

        $app->register(new ManagerServiceProvider());

        $app->boot();
    }
}
