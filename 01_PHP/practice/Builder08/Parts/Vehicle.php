<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午3:58
 */

namespace php\practice\Builder08\Parts;


abstract class Vehicle
{
    /**
     * @var object[]
     *
     */
    private $data = [];

    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
    }
}