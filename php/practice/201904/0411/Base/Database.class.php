<?php
/**
 * 单例模式:
 * 将构造函数设置为私有,然后创建静态方法getInstance, 创建静态属性$db, return new self();
 *
 *
 *
 *
 */

namespace Base;

interface IDatabase
{
    function connect($host, $user, $passwd, $dbname);
    function query($sql);
    function close();
}


class Database
{
    protected static $db = null;

    private function __construct()
    {
        $dsn = "mysql:dbname=testdb;host=127.0.0.1";
        $username = "root";
        $passwd = "root";

        $db = new \PDO($dsn, $username, $passwd, []);
    }

    public static function getInstance()
    {
        if (self::$db === null) {
            self::$db = new self();
        }
        return self::$db;
    }
}