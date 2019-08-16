<?php
/**
 * 装饰器方法, 我自己按照理解写的,不一定正确
 *
 * add类, 给调用的方法添加装饰器
 *
 */

namespace Base\Decorator;


/**
 * Class AddDecorator
 * @package Base\Decorator
 */
class AddDecorator
{
    /**
     * @var array
     */
    protected $decorators = [];

    /**
     * 添加一个装饰器
     *
     * @param Decorator $decorator
     * @return $this
     */
    public function add(Decorator $decorator)
    {
        $this->decorators[] = $decorator;
        return $this;
    }

    /**
     * 执行装饰器的before操作
     *
     *
     */
    protected function before()
    {
        foreach ($this->decorators as $decorator) {
            $decorator->before();
        }
    }

    /**
     * 执行装饰器的after操作
     *
     *
     */
    protected function after()
    {
        $decorators = array_reverse($this->decorators);
        foreach ($decorators as $decorator) {
            $decorator->after();
        }
    }

    /**
     *
     *
     * @param $obj
     * @param $method
     * @param $params
     * @return mixed
     */
    public function method($obj, $method, $params)
    {
        $this->before();
        $result = call_user_func_array([$obj, $method], $params);
        $this->after();

        return $result;
    }
}