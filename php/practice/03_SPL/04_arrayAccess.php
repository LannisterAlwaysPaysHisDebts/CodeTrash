<?php
/**
 * 数组式访问一个类
 */

class obj implements ArrayAccess
{
    private $container = [];

    public function __construct()
    {
        $this->container = [
            "one" => 1,
            "two" => 2,
            "three" => 3,
        ];
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}

$obj = new obj();

var_dump(isset($obj['two']));
var_dump($obj["two"]);
unset($obj['two']);
var_dump(isset($obj['two']));
$obj['two'] = 'A value';
var_dump($obj['two']);


