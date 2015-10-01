<?php

namespace Cekurte\Silex\Manager\Provider;

use Cekurte\Silex\Manager\Service\LoaderService;
use Cekurte\Silex\Manager\Service\LoaderService\ConfigFactory;
use Silex\Application;
use Silex\ServiceProviderInterface;

class ManagerServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        if (isset($app['cekurte.manager.providers']) && !empty($app['cekurte.manager.providers'])) {
            foreach ($app['cekurte.manager.providers'] as $provider => $config) {
                if (isset($config['register']) && $config['register'] === true) {
                    $loader = new LoaderService($provider);

                    if (isset($config['type'])) {
                        $configuration = (new ConfigFactory($config['type']))->process();

                        if (isset($config['src'])) {
                            $configuration->setResource($config['src']);
                        }

                        $loader->setConfig($configuration);
                    }

                    $loader->register($app);
                }
            }
        }
    }
}
