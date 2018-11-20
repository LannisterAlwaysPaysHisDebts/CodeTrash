<?php
/**
 * 入口文件  
 * 
 * 2018年11月20日
 * 版本1:
 * 实现最基本的m/c
 * 
 */

require __DIR__ . '/config.cfg.php';

class index
{
    public function index()
    {
        $m = $_GET['m'];
        $c = $_GET['c'];

        if (empty($m) || empty($c)) {
            $this->output([
                'Code' => 201,
                'Msg' => 'Error!'
            ]);
        }

        $m = ucfirst($m);
        $class = '\model\api\\' . $m . '.class.php';
        if (!method_exists($class, $c)) {
            $this->output([
                'Code' => 201,
                'Msg' => 'Error!'
            ]);
        }

        $obj = new $class;
        $result = $obj->$c();
        $this->output($result);
    }

    public function output(array $output)
    {
        header("Content-type: application/json;charset=utf-8");
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

(new index)->index();