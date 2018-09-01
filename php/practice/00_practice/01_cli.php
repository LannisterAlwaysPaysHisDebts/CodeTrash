<?php
// 只能够在cli模式下运行
if (php_sapi_name() != 'cli') {
    exit('Script Must Run In Cli');
}

// cli 模式下的脚本容易爆内存, 需要限制内存大小
ini_set('memory_limit', '1024M');

// cli 经常有死循环操作, 可以设计脚本运行时间, 为0就不限制
set_time_limit(0);

// 使用STDIN来阻塞输入
echo "请输入字符串: ";
$a = trim(fgets(STDIN));
echo "你输入的是: " . $a . "\n";


