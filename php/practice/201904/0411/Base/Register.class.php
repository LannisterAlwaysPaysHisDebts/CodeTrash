<?php
/**
 * 注册器模式
 *
 * 将内容注册到全局的静态注册树上
 *
 *
 */

namespace Base;


/**
 * Class Register
 * @package Base
 */
class Register
{
    /**
     * 注册树
     * @var
     */
    protected static $objects;

    /**
     * 保存一个实例
     * @param $alias
     * @param $object
     */
    public static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    /**
     * 获取一个实例
     * @param $name
     * @return mixed
     */
    public static function get($name)
    {
        return self::$objects[$name];
    }

    /**
     * 注销一个实例
     * @param $name
     */
    public static function _unset($name)
    {
        unset(self::$objects[$name]);
    }
}