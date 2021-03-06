<?php

namespace Cekurte\Silex\Manager\Service\LoaderService;

use Cekurte\Silex\Manager\Service\LoaderService\AbstractConfig;
use Cekurte\Silex\Manager\Service\LoaderService\ConfigInterface;

class ArrayConfig extends AbstractConfig implements ConfigInterface
{
    /**
     * Initialize
     */
    public function __construct()
    {
        $this->setType(ConfigInterface::TYPE_ARRAY);
    }

    /**
     * {@inheritdoc}
     */
    public function process()
    {
        if ($this->isType(ConfigInterface::TYPE_ARRAY) && !is_array($this->getResource())) {
            throw new \InvalidArgumentException('The configuration resource must be a array.');
        }

        return $this->getResource();
    }
}
