<?php
/**
 * 注册器模式
 *
 * 将内容注册到全局的静态注册树上
 *
 *
 */

namespace Base;


class Register
{
    protected static $objects;

    public static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    public static function get($name)
    {
        return self::$objects[$name];
    }

    public static function _unset($name)
    {
        unset(self::$objects[$name]);
    }
}