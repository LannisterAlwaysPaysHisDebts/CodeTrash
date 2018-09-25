<?php

// 连接swoole_server
$client = new swoole_client(SWOOLE_SOCK_TCP);

if(!$client->connect("127.0.0.1", 9501)) {
    echo "连接失败";
    exit();
}

// php cli常量
fwrite(STDOUT, "输入消息: ");
$msg = trim(fets(STDIN));

// 发送消息
$client->send($msg);

// 接受消息
$result = $client->recv();