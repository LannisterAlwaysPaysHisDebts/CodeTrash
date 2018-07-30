<?php
/**
 * 发送客服消息推送的基类
 *
 */

namespace Customer;

use Common\Bridge;
use Customer\Msg;

class CustomerService
{
    public function __call($name, $arguments)
    {
        if (!method_exists('Customer\Msg', $name)) {
            echo "没有这个方法\n\r";
            exit();
        }

        $this->send($name, $arguments);
    }

    protected function send($name, $arguments)
    {
        $request = get_request();
        $app_id = $request['app_id'];

        if (empty($app_id)) {
            exit('appid错误');
        }

        $conf = loadconf('wxapp/appid');
        if (!isset($conf[$app_id])) {
            exit('没有配置文件');
        }

        $pdo = $this->_getPdo($conf['db_name']);
        $time = time();
        $today = date('Y-m-d') . ' 00:00:00';

        //删除redis里面用户最近访问时间超过48小时的数据
        WeiXinCustomer::delUserByTime($time);

        $start = 0;
        $page_size = 300;
        while (true) {
            $result = WeiXinCustomer::getUserIdsByScoreLimit($start, $page_size, $time);
            if ($result['status'] != 200) {
                break;
            }
            $start += $page_size;
            $user_ids = $result['msg'];
            //查询登录时间小于今天0点用户发送客服推送
            $sql = "SELECT OpenId ,UserId FROM User WHERE UserId IN {$user_ids} AND LoginTime < {$today}";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $res = $pre->fetchAll();
            if (!empty($res)) {
                foreach ($res as $key => $value) {
                    // 拼上open_id
                    $args = array_merge([$value['OpenId']], $arguments);

                    // 调用对应的函数
                    call_user_func_array(array('Customer\Msg', $name), $args);
                }
            }
        }
    }

    /**
     * 数据库连接
     *
     * @param $db_name
     *
     * @return \PDO
     */
    protected function _getPdo($db_name)
    {
        $host = get_cfg_var("{$db_name}.mysql.default.read.db.host");
        $db = get_cfg_var("{$db_name}.mysql.default.read.db.name");
        $user = get_cfg_var("{$db_name}.mysql.default.read.db.user");
        $password = get_cfg_var("{$db_name}.mysql.default.read.db.password");

        try {
            $pdo_r = new \PDO("mysql:host={$host};dbname={$db}", $user, $password, [
                \PDO::ATTR_PERSISTENT => true
            ]);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return $pdo_r;
    }
}