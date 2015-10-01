<?php

namespace Cekurte\Silex\Manager\Service\LoaderService;

use Cekurte\Silex\Manager\Service\LoaderService\AbstractConfig;
use Cekurte\Silex\Manager\Service\LoaderService\ConfigInterface;

class ConfigFactory extends AbstractConfig
{
    use ConfigTrait;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @param  string $type
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($type)
    {
        $this->setType($type);
    }

    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $class = __NAMESPACE__ . '\\' . $this->getAllowedConfigTypes()[$this->getType()];

        return new $class();
    }
}
