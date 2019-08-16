<?php
/**
 * 适配器模式
 * mysqli
 *
 *
 */

class MySQLi implements IDatabase
{
    protected $conn;

    public function connect($host, $user, $passwd, $dbname)
    {
        $conn = mysqli_connect($host, $user, $passwd, $dbname);
        $this->conn = $conn;
    }

    public function query($sql)
    {
        return mysqli_query($sql, $this->conn);
    }

    public function close()
    {
        mysqli_close($this->conn);
    }
}