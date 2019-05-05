<?php
/**
 * 异步mysql
 *
 *
 *
 */

class AysMysql
{
    protected $dbSource = "";

    protected $dbConfig = [];

    public function __construct()
    {
//        new swoole_mysql()
        $this->dbSource = new Swoole\Mysql;

        $this->dbConfig = [
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => 'root',
            'database' => 'testdb',
            'charset' => 'utf8',
            'timeout' => 2
        ];
    }

    public function execute($id, $value)
    {
        // 回调函数参数: $db: swoole_mysql对象; $result: 是否连接成功,成功返回true,失败返回false
        $this->dbSource->connect($this->dbConfig, function (swoole_mysql $db, $result){
            if ($result === false) {
                var_dump($db->connect_errno);
            }

            $sql = "select * from test limit 1";

            $db->query($sql, function (swoole_mysql $db, $result){
                if ($result === false) {
                    echo "Error !";
                } elseif(is_array($result)) {
                    var_dump($result);
                }

                $db->close();
            });
        });
    }
}


