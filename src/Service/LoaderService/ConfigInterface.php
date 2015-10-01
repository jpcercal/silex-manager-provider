<?php

namespace Cekurte\Silex\Manager\Service\LoaderService;

interface ConfigInterface
{
    const TYPE_ARRAY = 'array';

    const TYPE_FILE_PHP = 'php';

    /**
     * Set the type of configuration
     *
     * @param string $type
     *
     * @return ConfigInterface
     */
    public function setType($type);

    /**
     * Set the resource of configuration
     *
     * @param mixed $resource
     *
     * @return ConfigInterface
     */
    public function setResource($resource);

    /**
     * Get the type of configuration
     *
     * @return string
     */
    public function getType();

    /**
     * Get the resource of configuration
     *
     * @return mixed
     */
    public function getResource();

    /**
     * @return array
     */
    public function process();
}
