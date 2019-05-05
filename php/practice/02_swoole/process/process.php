<?php
/**
 *
 * 进程
 *
 * 文档:
 * https://wiki.swoole.com/wiki/page/215.html
 *
 */



$process = new swoole_process(function (swoole_process $process){

    // todo:


    // 必须是详细的路径
    $process->exec("/usr/local/Cellar/php71/7.1.14_25/bin/php", [__DIR__ . '/../02_http_demo.php']);


}, true);

$myPid = getmypid();

// 相当于fork
$pid = $process->start();
echo "Master PID: {$myPid} Child PID: {$pid} " . PHP_EOL;

// 回收子进程
swoole_process::wait();