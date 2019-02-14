<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2018/9/21
 * Time: 下午5:08
 */


/**
 * 读取文件
 */
$result = swoole_async_readfile(__DIR__ . '/1.txt', function ($filename, $fileContent) {
    echo 'Filename:' . $filename . PHP_EOL;
    echo "Content: " . $fileContent . PHP_EOL;
});

// 执行成功则发挥true
var_dump($result);
echo "start" . PHP_EOL;
