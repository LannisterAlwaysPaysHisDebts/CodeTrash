<?php
/**
 * 异步写
 *
 * https://wiki.swoole.com/wiki/page/185.html
 *
 */

$content = ' new content';

/**
 * 末尾的flags默认0, 为覆盖写; 也可以传FILE_APPEND,为追加写
 *
 * 不能写大内容
 * 回调函数是写入完毕时回调
 *
 */
$res = swoole_async_writefile(__DIR__ . '/1.txt', $content, function (){
    echo "Write is ok " . PHP_EOL;
}, FILE_APPEND);


var_dump($res);