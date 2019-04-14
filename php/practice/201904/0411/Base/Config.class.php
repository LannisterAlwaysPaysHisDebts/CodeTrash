<?php

namespace Base;


/**
 * Class Config
 * @package Base
 */
class Config implements \ArrayAccess
{
    /**
     * @var
     */
    protected $path;
    /**
     * @var array
     */
    protected $config = [];

    /**
     * Config constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }


    /**
     * @param mixed $offset
     * @return mixed|void
     */
    public function offsetGet($offset)
    {
        if (empty($this->config[$offset])) {
            $filePath = $this->path . '/' . $offset;
            $config = require $filePath;
            $this->config[$offset] = $config;
        }

        return $this->config[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * @param mixed $offset
     * @return bool|void
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}