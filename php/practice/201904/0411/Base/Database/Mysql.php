<?php
/**
 * 适配器模式
 * Mysql
 *
 *
 */
namespace Base\Database;

class Mysql implements \Base\IDatabase
{
    protected $conn;

    public function connect($host, $user, $passwd, $dbname)
    {
        $conn = @mysql_connect($host, $user, $passwd);
        @mysql_select_db($dbname, $conn);
        $this->conn = $conn;
    }

    public function query($sql)
    {
        return mysql_query($sql, $this->conn);
    }

    public function close()
    {
        mysql_close($this->conn);
    }
}