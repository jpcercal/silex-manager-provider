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
        $this->setTypeAsString($type);
    }

    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $class = __NAMESPACE__ . '\\' . current($this->getType());

        return new $class();
    }
}
