<?php
/**
 * 静态工厂模式
 * 不new对象而是通过一个静态方法来获取一个对象
 *
 *
 *
 */

namespace Base;

use Base\ORM\UserInvite;
use Base\Database\PDO;

class MySqlFactory
{
    public static function createDb()
    {
        $obj = Database::getInstance();
        Register::set('db1', $obj);
        return $obj;
    }

    public static function getDb()
    {
        $db = Register::get("db");
        if (!$db) {
            $db = new PDO();
            $db->connect("127.0.0.1", "root", "root", "testdb");
            Register::set('db', $db);
        }
        return $db;
    }

    public static function getUserInvite($id)
    {
        $key = "UserInvite_{$id}";
        $userInvite = Register::get($key);
        if (!$userInvite) {
            $userInvite = new UserInvite($id);
            Register::set($key, $userInvite);
        }

        return $userInvite;
    }
}