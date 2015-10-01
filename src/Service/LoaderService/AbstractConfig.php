<?php

namespace Cekurte\Silex\Manager\Service\LoaderService;

abstract class AbstractConfig implements ConfigInterface
{
    use ConfigTrait;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $resource;

    /**
     * Check the type of config
     *
     * @param  string  $type
     *
     * @return boolean
     */
    protected function isType($type)
    {
        return $this->getType() === $type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('The type must be a string');
        }

        if (empty($type)) {
            throw new \InvalidArgumentException('The type can not be empty');
        }

        $allowedConfigTypes = $this->getAllowedConfigTypes();

        if (!array_key_exists($type = strtolower($type), $allowedConfigTypes)) {
            throw new \InvalidArgumentException(sprintf(
                'The type "%s" is invalid, use one of this types %s.',
                $type,
                implode(', ', $allowedConfigTypes)
            ));
        }

        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getResource()
    {
        return $this->resource;
    }
}
