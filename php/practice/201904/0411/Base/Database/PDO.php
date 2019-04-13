<?php
/**
 * 适配器模式
 * pdo
 *
 *
 */

namespace Base\Database;

use Base\IDatabase;

/**
 * Class PDO
 * @package Base\Database
 */
class PDO implements IDatabase
{
    /**
     * @var \PDO
     */
    protected $conn;

    /**
     * @param $host
     * @param $user
     * @param $passwd
     * @param $dbname
     */
    public function connect($host, $user, $passwd, $dbname)
    {
       $this->conn  = new \PDO("mysql:host={$host};dbname={$dbname}", $user, $passwd);
    }

    /**
     * @param $sql
     *
     * @return
     */
    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    /**
     *
     */
    public function close()
    {
        unset($this->conn);
    }
}