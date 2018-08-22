<?php
// 创建server对象, 类型为swoole_sock_udp
$serv = new swoole_server('127.0.0.1', 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$serv->on('Packet', function($serv, $data, $clientInfo){
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server" . $data);
    var_dump($clientInfo);
});

$serv->start();
