<?php
/**
 * 异步读
 *
 * https://wiki.swoole.com/wiki/page/184.html
 *
 *
 *
 *
 */


/**
 * 读取文件
 *
 * 直接复制到内存,不能用于大文件读取
 *
 *
 */
$result = swoole_async_readfile(__DIR__ . '/1.txt', function ($filename, $fileContent) {
    echo 'Filename:' . $filename . PHP_EOL;
    echo "Content: " . $fileContent . PHP_EOL;
});

// 执行成功则发挥true
var_dump($result);
echo "start" . PHP_EOL;
