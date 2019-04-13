<?php
/**
 * 静态工厂模式
 * 不new对象而是通过一个静态方法来获取一个对象
 *
 *
 *
 */

namespace Base;



class MySqlFactory
{
    protected static $tree = [];

    public static function createDb($db = 'default_r')
    {
        if (isset(self::$tree[$db])) {
            return self::$tree[$db];
        }

        $obj = Database::getInstance();
        self::$tree[$db] = $obj;
        return $obj;
    }
}