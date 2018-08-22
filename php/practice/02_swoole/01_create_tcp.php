<?php
/**
 * 创建php tcp服务器
 */

// 新建Server对象, 监听9501端口
$serv = new swoole_server("127.0.0.1", 9501);

// 监听连接事件  $fd是客户端连接的唯一标识符
$serv->on('connect', function ($serv, $fd){
    echo "Client: Connect. \n";
});

// 监听数据接受事件
$serv->on('receive', function($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: " . $data);
});

// 监听连接关闭事件
$serv->on('close', function ($serv, $fd){
    echo "Client: Close. \n";
});

// 启动服务器
$serv->start();