<?php
/**
 * 开启多进程操作的demo
 */

function fork($callback)
{
    $pid = pcntl_fork();
    if ( $pid == -1) {
        exit("fork progress error!\n");
    } else if ($pid == 0) {
        $pid = posix_getpid();
        $callback();
        exit("({$pid})child progress end!\n");
    }else{
        return $pid;
    }
}

// 进程数量
$n = 5;
for ($i = 0; $i < $n; $i++) {
    $pid = createProgress('test');
    $childList[$pid] = 1;
}

// 等待所有子进程结束
while(!empty($childList)){
    $childPid = pcntl_wait($status);
    if ($childPid > 0){
        unset($childList[$childPid]);
    }
}
echo "({$parentPid})main progress end!\n";

function test()
{
    sleep(5);
}