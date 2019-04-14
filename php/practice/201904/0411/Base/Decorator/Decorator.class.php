<?php
/**
 * 装饰器方法, 我自己按照理解写的,不一定正确
 *
 * 接口, 提供before和after两种方法
 *
 */

namespace Base\Decorator;


interface Decorator
{
    public function before();

    public function after();
}