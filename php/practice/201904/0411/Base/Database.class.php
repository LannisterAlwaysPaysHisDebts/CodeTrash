<?php
/**
 *
 *
 *
 *
 */

namespace Base;



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