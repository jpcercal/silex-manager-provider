<?php

namespace Cekurte\Silex\Manager\Service\LoaderService;

use Cekurte\Silex\Manager\Service\LoaderService\AbstractConfig;
use Cekurte\Silex\Manager\Service\LoaderService\ConfigInterface;

class FilePhpConfig extends AbstractConfig implements ConfigInterface
{
    /**
     * Initialize
     */
    public function __construct()
    {
        $this->setType(ConfigInterface::TYPE_FILE_PHP);
    }

    /**
     * {@inheritdoc}
     */
    public function process()
    {
        if ($this->isType(ConfigInterface::TYPE_FILE_PHP) && !is_string($this->getResource())) {
            throw new \InvalidArgumentException('The configuration resource must be a valid value.');
        }

        if (!file_exists($this->getResource())) {
            throw new \InvalidArgumentException(sprintf(
                'The configuration resource file "%s" not exists.',
                $this->getResource()
            ));
        }

        return require $this->getResource();
    }
}
