<?php

namespace Cekurte\Silex\Manager\Service\LoaderService;

abstract class AbstractConfig implements ConfigInterface
{
    use ConfigTrait;

    /**
     * @var array
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
        return key($this->getType()) === $type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(array $type)
    {
        if (empty($type)) {
            throw new \InvalidArgumentException('The type can not be empty');
        }

        if (count($type) !== 1) {
            throw new \InvalidArgumentException('The type must be one element only');
        }

        if (!is_string(key($type))) {
            throw new \InvalidArgumentException('The type key must be a string');
        }

        if (!is_string(current($type))) {
            throw new \InvalidArgumentException('The type value must be a string');
        }

        $allowedConfigTypes = $this->getAllowedConfigTypes();

        if (!array_key_exists(key($type), $allowedConfigTypes)) {
            throw new \InvalidArgumentException(sprintf(
                'The type "%s" is invalid, use one of this types %s.',
                key($type),
                implode(', ', array_keys($allowedConfigTypes))
            ));
        }

        $this->type = $type;

        return $this;
    }

    public function setTypeAsString($type)
    {
        $allowedConfigTypes = $this->getAllowedConfigTypes();

        foreach ($allowedConfigTypes as $key => $value) {
            if (strtolower($type) === strtolower($key)) {
                return $this->setType([$key => $value]);
            }
        }

        throw new \InvalidArgumentException(sprintf('The type with key "%s" was not found', $type));
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
