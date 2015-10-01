<?php

namespace Cekurte\Silex\Manager\Service\LoaderService;

use Cekurte\Silex\Manager\Service\LoaderService\ConfigInterface;

trait ConfigTrait
{
    /**
     * @return array
     */
    public function getAllowedConfigTypes()
    {
        return [
            ConfigInterface::TYPE_ARRAY    => 'ArrayConfig',
            ConfigInterface::TYPE_FILE_PHP => 'FilePhpConfig',
        ];
    }
}
