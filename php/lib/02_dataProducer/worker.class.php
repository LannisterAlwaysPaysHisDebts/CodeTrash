<?php
/**
 * 1. 完成数据库的连接;
 * 2. 获取数据规则;
 * 3. 向生产者发送请求获取随机数据
 *
 */

namespace dataProducer;

class worker
{
    protected $pdo;

    public function connectDB($dbname, $user, $pwd)
    {
        try{
            $this->pdo = new \PDO('dblib:host=127.0.0.1;dbname=' . $dbname . ';charset=utf8mb4', $user, $pwd);
        }catch (\PDOException $e) {
            return ['Code' => 201, 'Msg' => $e->getMessage()];
        }

        return ['Code' => 200];
    }
}