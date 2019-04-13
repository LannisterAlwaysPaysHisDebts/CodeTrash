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
    public static function createDb()
    {
        $obj = Database::getInstance();
        Register::set('db1', $obj);
        return $obj;
    }
}